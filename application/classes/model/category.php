<?php defined('SYSPATH') or die('No direct script access.');

// Model of categories
Class Model_Category extends ORM {

    protected $db;
    protected $breadcrumbs;

    // Check if category exists
    function check_category($catid)
    {
        $this->db = ORM::factory('category')
                ->where('id', '=', $catid)
                ->find();

        if(!empty($this->db->id))
        {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    // Select main categories
    function show_main()
    {
        $this->db = ORM::factory('category')
                ->where('parent', '=', 0)
                ->find_all();

        return $this->db;
    }

    // Show secondary categories
    function show_secondary($parent)
    {
        $parent = (int) $parent;

        $this->db = ORM::factory('category')
                ->where('parent', '=', $parent)
                ->find_all();

        return $this->db;
    }

    // Generate breadcrumbs
    function breadcrumbs($parent)
    {
        $this->breadcrumbs = array();

        do
        {
            if(!empty($this->db->parent))
            {
                $parent = $this->db->parent;
            }

            $this->db = ORM::factory('category')
                    ->where('id', '=', $parent)
                    ->find();
            
            $this->breadcrumbs[] = array(
                'name' => $this->db->name,
                'url' => $this->db->url.'-'.$this->db->id
                );
        }
        while($this->db->parent != 0);

        return $this->breadcrumbs;
    }

}