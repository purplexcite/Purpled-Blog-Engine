<?php defined('SYSPATH') or die('No direct script access.');

// Commentaries model
Class Model_Comment extends ORM {

    protected $db;
    protected $validation;

    // Get commentaries of post
    function get_comments($postid)
    {
        $this->db = ORM::factory('comment')
                ->where('postid', '=', $postid)
                ->find_all();

        return $this->db;
    }

    // Get count of comments of post
    function get_count($postid)
    {
        $this->db = ORM::factory('comment')
                ->where('postid', '=', $postid)
                ->count_all();

        return $this->db;
    }

    // Validate new comment
    function validate_comment()
    {
        $this->validation = Validate::factory($_POST)
                ->label('username', 'имя')
                ->label('url', 'сайт')
                ->label('text', 'текст')
                ->rule('username', 'max_length', array('25'))
                ->rule('url', 'max_length', array ('64'))
                ->rule('url', 'url')
                ->rule('text', 'max_length', array('1024'))
                ->rule('username', 'not_empty')
                ->rule('text', 'not_empty');

        if($this->validation->check())
        {
            return TRUE;
        }
        else
        {
            return strtolower(implode(' и ', $this->validation->errors('')));
        }
    }

    // Add new comment to database
    function add_comment($postid)
    {
        $this->db = ORM::factory('comment');
        $this->db->username = strip_tags($_POST['username']);
        $this->db->url = $_POST['url'];
        $this->db->text = strip_tags($_POST['text']);
        $this->db->postid = $postid;
        $this->db->save();
    }

    // Get last comments
    function last_comments($count)
    {
        $this->db = ORM::factory('comment')
                ->select(array('posts.url', 'post_url'), array('posts.id', 'post_id'))
                ->join('posts')
                ->on('posts.id', '=', 'comments.postid')
                ->order_by('comments.id', 'DESC')
                ->limit($count)
                ->offset(0)
                ->find_all();

        return $this->db;
    }

}