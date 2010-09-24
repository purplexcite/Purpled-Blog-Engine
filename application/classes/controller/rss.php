<?php defined('SYSPATH') or die('No direct script access.');

Class Controller_Rss extends Controller_Template {

    public $template = 'rss';

    function action_show()
    {
        $this->model_rss = new Model_Rss;

        $this->template->title = Kohana::config('site.title');
        $this->template->description = Kohana::config('site.description');
        $this->template->feed = $this->model_rss->get_data();
    }

}