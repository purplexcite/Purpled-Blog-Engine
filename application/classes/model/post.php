<?php defined('SYSPATH') or die('No direct script access.');

// Model of posts
Class Model_Post extends ORM {

    protected $db;

    // Show post by id
    function show_post($postid)
    {
        $this->db = ORM::factory('post')
                ->select('users.username')
                ->join('users')
                ->on('users.id', '=', 'posts.author')
                ->where('posts.id', '=', $postid)
                ->find();

        return $this->db;
    }

    // Get category id by post id
    function get_category($postid)
    {
        $this->db = ORM::factory('post')
                ->where('id', '=', $postid)
                ->find();

        return $this->db->catid;
    }

    // Check if post exists
    function check_post($postid)
    {
        $this->db = ORM::factory('post')
                ->where('id', '=', $postid)
                ->find();

        if(!empty($this->db->id))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    // Select all posts
    function show_all($limit, $offset, $category = NULL, $search = '%')
    {

        if($category == NULL)
        {
            $this->db = ORM::factory('post')
                ->select('users.username')
                ->join('users')
                ->on('posts.author', '=', 'users.id')
                ->where('content', 'like', $search)
                ->or_where('title', 'like', $search)
                ->order_by('id', 'DESC')
                ->limit($limit)
                ->offset($offset)
                ->find_all();
        }
        else
        {
            $category = (int) $category;

            $this->db = ORM::factory('post')
                ->select('users.username')
                ->join('users')
                ->on('posts.author', '=', 'users.id')
                ->where_open()
                ->where('content', 'like', $search)
                ->or_where('title', 'like', $search)
                ->where_close()
                ->where('catid', '=', $category)
                ->order_by('id', 'DESC')
                ->limit($limit)
                ->offset($offset)
                ->find_all();
        }

        return $this->db;
    }

    // Select count of posts for pagination
    function count($category = 0, $search = '%')
    {
        if($category == 0)
        {
            $this->db = ORM::factory('post')
                ->where('content', 'like', $search)
                ->or_where('title', 'like', $search)
                ->count_all();
        }
        else
        {
            $category = (int) $category;

            $this->db = ORM::factory('post')
                ->where_open()
                ->where('content', 'like', $search)
                ->or_where('title', 'like', $search)
                ->where_close()
                ->and_where('catid', '=', $category)
                ->count_all();
        }

        return $this->db;
    }

    // Check if post allowed to be commented
    function get_access($postid)
    {
        $this->db = ORM::factory('post')
                ->where('id', '=', $postid)
                ->find();

        return $this->db->allowcomment;
    }

}