<?php defined('SYSPATH') or die('No direct script access.');

// Abstract view controller, models init
class Controller_Abstract extends Controller_Template {

	public $template = 'abstract';

        function before()
        {
            parent::before();

            $this->template->title = Kohana::config('site.title');
            $this->template->description = Kohana::config('site.description');

            $this->post = new Model_Post;
            $this->category = new Model_Category;
            $this->comment = new Model_Comment;

            $this->cat = $this->request->param('category');
            $this->posts = $this->request->param('post');

            if(!empty($_GET['q']))
            {
                $this->search = '%'.$_GET['q'].'%';
            }
            else
            {
                $this->search = '%';
            }

            if(!empty($this->posts))
            {
                $this->posts = explode('-', $this->posts);
                $this->postid = $this->posts[count($this->posts) - 1];

                $this->check_post = $this->post->check_post($this->postid);

                if($this->check_post == FALSE)
                {
                    $this->request->redirect('');
                }
            }
            else
            {
                $this->postid = 0;
            }

            if(!empty($this->cat))
            {
                $this->cat = explode('-', $this->cat);
                $this->catid = $this->cat[count($this->cat) - 1];

                $this->check_category = $this->category->check_category($this->catid);

                if($this->check_category == FALSE)
                {
                    $this->request->redirect('');
                }

                $this->pag_objects = $this->post->count($this->catid, $this->search);
            }
            else
            {
                $this->catid = 0;
                $this->pag_objects = $this->post->count($this->catid, $this->search);
            }

            if(!empty($this->postid))
            {
                $this->catid = $this->post->get_category($this->postid);
            }

            $this->pag_data = array(
                'total_items' => $this->pag_objects,
                'items_per_page' => 5,
                'current_page' => array(
                        'source' => 'route',
                        'key' => 'page',
                        ),
            );

            $this->pagination = Pagination::factory($this->pag_data)->render();

            $this->breadcrumbs = $this->category->breadcrumbs($this->catid);
        }

}

// Work with site
class Controller_Site extends Controller_Abstract {

    // Init site content
    function action_show_all()
    {
        $this->action_main_categories();

        // If viewing index page show index, else show secondary categories and posts
        if(Request::instance()->param('id') == FALSE)
        {
            $this->template->content = View::factory('index');
            $this->action_show_posts();
            $this->template->content->pagination = $this->pagination;
        }

        $this->template->breadcrumbs = $this->breadcrumbs;
    }

    // Show all posts
    function action_show_posts()
    {
        $page = $this->request->param('page');

        if(empty($page))
        {
            $page = 1;
        }

        if(!empty($this->catid))
        {
            $this->template->content->categories = $this->category->show_secondary($this->catid);
            $this->template->title_info = $this->category->get_title($this->catid);
            $this->template->content->posts = $this->post->show_all(5, 5 * ($page - 1), $this->catid, $this->search);
        }
        else
        {
            $this->template->content->posts = $this->post->show_all(5, 5 * ($page - 1), NULL, $this->search);
        }
    }

    // Show main categories
    function action_main_categories()
    {
        $this->template->main_categories = $this->category->show_main();
        $this->template->last_comments = $this->comment->last_comments(Kohana::config('site.comments_count'));
    }

    // Search posts
    function action_search()
    {
        $this->template->content = View::factory('index');
        $this->template->content->pagination = $this->pagination;
        $this->template->content->pages = $this->action_show_posts();
        $this->template->breadcrumbs = $this->breadcrumbs;
        $this->action_main_categories();
    }

    // Show selected post and commentaries
    function action_show_post()
    {
        $this->action_post_main();

        $this->allowcomment = $this->post->get_access($this->postid);

        if($this->allowcomment == 1)
        {
            $this->action_comments_params();
        }
        else {
            $this->template->content->comment = '<i>Запрещено комментирование</i>';
        }

        $this->action_main_categories();
    }

    // Comments parametres
    function action_comments_params()
    {
        $this->count_comments = $this->comment->get_count($this->postid);
        $this->template->content->comments_count = $this->count_comments;
        $this->template->content->id = $this->postid;
        $this->template->content->comment = '<i>Комментариев: '.$this->count_comments.'</i>';
        $this->template->content->comments = $this->comment->get_comments($this->postid);
    }

    // Some anti-doublecode
    function action_post_main()
    {
        $this->template->content = View::factory('post');
        $this->template->breadcrumbs = $this->breadcrumbs;
        $this->template->content->title = $this->post->show_post($this->postid)->title;
        $this->template->title_info = $this->post->show_post($this->postid)->title;
        $this->template->content->text = $this->post->show_post($this->postid)->content;
        $this->template->content->posted = $this->post->show_post($this->postid)->posted;
        $this->template->content->author = $this->post->show_post($this->postid)->username;
    }

    // Add new comment
    function action_add_comment($postid)
    {
        $this->allowcomment = $this->post->get_access($this->postid);

        $this->action_post_main();
        $this->action_main_categories();

        if(Captcha::valid($_POST['captcha']) AND $this->allowcomment == 1)
        {
            $this->validate = $this->comment->validate_comment();

            if($this->post->check_post($postid) == TRUE AND $this->validate === TRUE)
            {
                $this->comment->add_comment($postid);
            }
            else
            {
                $this->template->content->errors = $this->validate;
            }
        }

        $this->action_comments_params();
    }

}