<?php defined('SYSPATH') or die('No direct script access.');

Class Model_Admin_Post extends Model {

    protected $db;
    protected $tmp;

    // Select all posts
    function select_posts()
    {
        return ORM::factory('post')->find_all();
    }

    // Add new post
    function add_new()
    {
        $this->db = ORM::factory('post');

        $this->db->title = $_POST['title'];
        $this->db->content = $_POST['content'];
        $this->db->url = preg_replace('/[\-]+/', '-', $_POST['url']);
        $this->db->allowcomment = (!empty($_POST['allowcomment']) ? 1 : 0);
        $this->db->catid = $_POST['category'];
        $this->db->posted = date('Y-m-d');
        $this->db->author = Auth::instance()
                                    ->get_user()
                                    ->id;

        $this->db->save();
    }

    // Edit post
    function edit_post()
    {
        if(!empty($_POST['delete']))
        {
            $this->db = ORM::factory('post')
                    ->delete($_POST['delete']);

            return;
        }

        $this->db = ORM::factory('post', $_POST['id']);

        $this->db->title = $_POST['title'];
        $this->db->content = $_POST['content'];
        $this->db->url = preg_replace('/[\-]+/', '-', $_POST['url']);
        $this->db->allowcomment = (!empty($_POST['allowcomment']) ? 1 : 0);
        $this->db->catid = $_POST['category'];
        $this->db->author = Auth::instance()
                                    ->get_user()
                                    ->id;

        $this->db->save();
    }

}