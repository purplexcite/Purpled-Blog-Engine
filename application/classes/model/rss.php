<?php defined('SYSPATH') or die('No direct script access.');

Class Model_Rss extends Model {

    protected $db;

    function get_data()
    {
        $this->db = DB::select()
                ->from('posts')
                ->order_by('id', 'DESC')
                ->execute();

        return $this->db;
    }

}