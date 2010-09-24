<?php defined('SYSPATH') or die('No direct script access.');

Class Model_Admin_Comment extends Model {

    protected $db;
    protected $this;

    // Search comments by id
    function search_comments()
    {
        $this->db = ORM::factory('comment')
                ->where('postid', '=', $_POST['id'])
                ->find_all();

        return $this->db;
    }

    // Edit comments
    function edit_comments()
    {
        // Check if delete requested
        if(!empty($_POST['delete']))
        {
            $this->tmp = count($_POST['delete']);

            for($i = 0; $i < $this->tmp; $i++)
            {
                $this->db = ORM::factory('comment')
                                ->delete($_POST['delete'][$i]);
            }
        }

        // Edit else
        $this->tmp = count($_POST['username']);

        for($i = 0; $i < $this->tmp; $i++)
        {
            $this->db = ORM::factory('comment', $_POST['id'][$i]);

            $this->db->username = $_POST['username'][$i];
            $this->db->text = $_POST['text'][$i];
            $this->db->url = $_POST['url'][$i];

            $this->db->save();
        }
    }

}