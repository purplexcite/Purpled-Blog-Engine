<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru-RU">
    <head>
        <title><?php echo $title.' - '.(!empty($title_info) ? $title_info : 'Главная страница') ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="keywords" content="разработка на kohana, программирование на kohana framework, изучение kohana framework, блог по программированию, kohana framework, <?php echo (!empty($title_info) ? $title_info : '') ?>" />
        <meta name="description" content="Блог purplexcite" />
        <meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="pragma" content="no-cache" />
        <meta name="Robots" content="index,follow" />
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="alternate" type="application/rss+xml" href="http://purpled.biz/rss/" title="Последние сообщения" />
        <?php echo html::style('media/css/site.css') ?>
    </head>
    <body>
        <div class="logo">
        <div class="wrapper_header">
            <div class="logo_name"><?php echo $title ?></div>
            <div class="logo_text"><?php echo $description ?></div>
            <div class="logo_contacts">
                <b>Электронная почта:</b> <?php echo html::mailto('test@test.com') ?>
            </div>
        </div>
        </div>
        <div class="wrapper">
        <div style="float: left;">
            <div class="category">
                <p>
                <div class="category_title">Категории</div>
                <ul>
                    <?php

                        foreach($main_categories as $category)
                        {
                            echo '<li>'.html::anchor('category/'.$category->url.'-'.$category->id, $category->name).'</li>';
                        }

                    ?>
                </ul>

                <div class="category_title">Поиск</div>
                <center>
                <p>
                <?php

                        echo form::open('search', array(
                                    'method' => 'get'
                                    ));
                        echo form::input('q', !empty($_GET['q']) ? $_GET['q'] : '', array('style' => 'width: 137px'));
                        echo form::submit('submit', 'ок');
                        echo form::close();

                ?>
                </center>
                <p>

                <div class="category_title" style="">Комментарии</div>
                <ul>
                    <?php

                        foreach($last_comments as $comment)
                        {
                            echo '<ul>';
                            echo '<li>&mdash;'.html::anchor('post/'.$comment->post_url.'-'.$comment->post_id, mb_substr($comment->text, 0, 30).'...').'</li><li>&nbsp;</li>';
                            echo '</ul>';
                        }

                    ?>
                </ul>
            </div>
            <div style="clear: left;"></div>
        </div>
        <div class="breadcrumb">
            <div class="breadcrumb_text">

                <?php

                    $breadcrumbs = array_reverse($breadcrumbs);

                    if(empty($breadcrumbs[0]['name']))
                    {
                        echo html::anchor('', 'Главная страница');
                    }
                    else
                    {
                        echo html::anchor('', 'Главная страница').' / ';

                        foreach($breadcrumbs as $key => $value)
                        {
                            if($key == count($breadcrumbs) - 1)
                            {
                                $amp = '';
                            }
                            else
                            {
                                $amp = ' / ';
                            }

                        echo html::anchor('category/'.$value['url'], $value['name']).$amp;
                        }
                    }

                ?>

            </div>
        </div>
        <div class="content">
            <?php

                echo $content;

            ?>
        </div>

        <div style="clear: left;"></div>

        <p align="center">
        &#169; purpled.biz, 2010
        </div>
    </body>
</html>