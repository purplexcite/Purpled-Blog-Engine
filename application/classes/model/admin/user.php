<?php defined('SYSPATH') or die('No direct script access.');

Class Model_Admin_User extends Model {

    protected $db;
    protected $tmp;

    // Get users list
    function select_users()
    {
        $this->db = ORM::factory('user')->find_all();

        return $this->db;
    }

    // Add new user
    function new_user()
    {
        // Save new user
        $this->db = ORM::factory('user');
        $this->db->username = $_POST['new_login'];
        $this->db->password = $_POST['new_password'];
        $this->db->email = rand(1, 999999).'@'.rand(1, 999999).'.com'; // Email isn't neccessary and i don't want to change default DB structure of Auth module
        $this->db->save();
        $this->db->add('roles', ORM::factory('role', 1));
    }

    // Modify and/or delete users
    function edit_user()
    {
        // Check if needed to delete users
        if(!empty($_POST['delete']))
        {
            $this->tmp = count($_POST['delete']);

            for($i = 0; $i < $this->tmp; $i++)
            {
                $this->db = ORM::factory('user')
                        ->delete($_POST['delete'][$i]);
            }
        }

        // After lets edit users information
        $this->tmp = count($_POST['username']);

        for($i = 0; $i < $this->tmp; $i++)
        {
            $this->db = ORM::factory('user', $_POST['uid'][$i]);
            
            $this->db->username = $_POST['username'][$i];
            
            if(!empty($_POST['password'][$i]))
            {
                $this->db->password = $_POST['password'][$i];
            }

            $this->db->where('username', '=', $_POST['username'][$i])->save();
        }
    }

}