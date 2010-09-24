<?php defined('SYSPATH') or die('No direct script access.');

// Abstract controller of admin panel
Class Controller_Admin_Abstract extends Controller_Template {

    public $template = 'admin/abstract';

    function before()
    {
        parent::before();

        $this->auth = Auth::instance();
        $this->user = $this->auth->get_user();

        $this->model_user = new Model_Admin_User;
        $this->model_category = new Model_Admin_Category;
        $this->model_post = new Model_Admin_Post;
        $this->model_user_post = new Model_Post;
        $this->model_comment = new Model_Admin_Comment;
    }

}

// Main controller
Class Controller_Admin_Main extends Controller_Admin_Abstract {

    // Check if already logged in
    function action_start()
    {
        // If user not logged
        if($this->user == FALSE)
        {
            $this->template->content = View::factory('admin/login');
        }
        else
        {
            $this->template->content = View::factory('admin/main');
            $this->template->content->login = $this->user->username;
            $this->template->content->category = $this->request->action;
        }
    }

    // Check login and password
    function action_login()
    {
        if($_POST)
        {
            if(Captcha::valid($_POST['captcha']) AND $this->auth->login($_POST['username'], $_POST['password'], !empty($_POST['remember']) ? TRUE : FALSE) == TRUE)
            {
                $this->request->redirect('admin');
            }
            else
            {
                $this->request->redirect('admin');
            }
        }
    }

    // Logout current user
    function action_logout()
    {
        $this->auth->logout();
        $this->request->redirect('admin');
    }

    // Users administration
    function action_users()
    {
        $this->action_start();
        $this->template->content->page = View::factory('admin/users')
                ->set('users', $this->model_user->select_users());

        switch($this->request->param('param'))
        {
            case 'new':
                $this->model_user->new_user();
                $this->request->redirect('admin/users');

                break;

            case 'edit':
                $this->model_user->edit_user();
                $this->request->redirect('admin/users');

                break;
        }
    }

    // Categories administration
    function action_categories()
    {
        $this->action_start();
        $this->template->content->page = View::factory('admin/categories')
                ->set('categories', $this->model_category->select_categories(0));

        switch($this->request->param('param'))
        {
            case 'new':
                $this->model_category->add_category();
                $this->request->redirect('admin/categories');

                break;
            case 'edit':
                $this->model_category->edit_category();
                $this->request->redirect('admin/categories');

                break;
        }
    }

    // Posts administration
    function action_posts()
    {
        $this->action_start();

        if($this->request->param('param') == 'new')
        {
            $this->template->content->page = View::factory('admin/new_post')
                ->set('categories', $this->model_category->select_categories(0));

            if($_POST)
            {
                $this->model_post->add_new();
                $this->request->redirect('admin/posts');
            }
        }
        else
        {
            $this->template->content->page = View::factory('admin/posts');

            switch($this->request->param('param'))
            {
                case 'search':
                    $this->template->content->page->post = $this->model_user_post->show_post($_POST['id']);
                    $this->template->content->page->categories = $this->model_category->select_categories(0);

                    break;
                case 'edit':
                    $this->model_post->edit_post();
                    $this->request->redirect('admin/posts');

                    break;
            }
        }
    }

    // Commentaries administration
    function action_comments()
    {
        $this->action_start();
        $this->template->content->page = View::factory('admin/comments');

        switch($this->request->param('param'))
        {
            case 'search':
                $this->template->content->page->comments = $this->model_comment->search_comments();
                
                break;
            case 'edit':
                $this->model_comment->edit_comments();
                $this->request->redirect('admin/comments');

                break;
        }
    }

}