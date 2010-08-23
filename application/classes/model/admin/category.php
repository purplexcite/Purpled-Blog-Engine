<?php defined('SYSPATH') or die('No direct script access.');

Class Model_Admin_Category extends Model {

    protected $db;
    protected $tmp;

    // Get all categories as hierarchical list
    function select_categories($cat_id)
    {
        $this->db = ORM::factory('category')
                ->where('parent', '=', $cat_id)
                ->find_all();

        foreach ($this->db as $num => $category)
        {
            $this->tmp[$category->parent][$category->id] = &$this->tmp[$category->id];

            $this->select_categories($category->id);
        }

        return $this->tmp;
    }

    // Update categories
    function edit_category()
    {
        // Check if neccessary to delete
        if(!empty($_POST['delete']))
        {
            $this->tmp = count($_POST['delete']);

            for($i = 0; $i < $this->tmp; $i++)
            {
                $this->db = ORM::factory('category')
                        ->delete($_POST['delete'][$i]);

                // Clean posts of this category
                DB::delete('posts')
                        ->where('catid', '=', $_POST['delete'][$i])
                        ->execute();
            }
        }

        // Update info
        $this->tmp = count($_POST['name']);

        for($i = 0; $i < $this->tmp; $i++)
        {
            $this->db = ORM::factory('category', $_POST['cid'][$i]);

            $this->db->name = $_POST['name'][$i];
            $this->db->url = preg_replace('/[\-]+/', '-', $_POST['url'][$i]);

            $this->db->save();
        }
    }

    // Add new
    function add_category()
    {
        $this->db = ORM::factory('category');
        
        $this->db->name = $_POST['new_name'];
        $this->db->url = preg_replace('/[\-]+/', '-', $_POST['new_url']);
        $this->db->parent = $_POST['new_category'];

        $this->db->save();
    }

}