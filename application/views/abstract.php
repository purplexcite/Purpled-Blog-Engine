<html>
    <head>
        <title><?php echo $title ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="pragma" content="no-cache">
        <link rel="shortcut icon" href="favicon.ico">
        <?php echo html::style('media/css/site.css') ?>
    </head>
    <body>
        <div class="logo">
            <div class="logo_name"><?php echo $title ?></div>
            <div class="logo_text"><?php echo $description ?></div>
            <div class="logo_contacts">
                <b>Электронная почта:</b> <?php echo html::mailto('test@test.com') ?>
            </div>
        </div>
        <div style="float: left;">
            <div class="category">
                <div class="category_title">Категории</div>
                <ul>
                    <?php

                        foreach($main_categories as $category)
                        {
                            echo '<li>'.html::anchor('category/'.$category->url.'-'.$category->id, $category->name).'</li>';
                        }

                    ?>
                </ul>
            </div>
            <div style="clear: left;"></div>
            <div class="category">
                <div class="category_title">Поиск</div>
                <?php

                        echo form::open('search', array(
                                    'method' => 'get'
                                    ))

                ?>
                <ul>
                    <li><?php echo form::input('q', !empty($_GET['q']) ? $_GET['q'] : '') ?></li>
                    <li><?php echo form::submit('submit', 'Поиск сообщений') ?></li>
                </ul>
                <?php echo form::close() ?>
            </div>
            <div style="clear: left;"></div>
            <div class="category">
                <div class="category_title" style="">Комментарии</div>
                <ul>
                    <?php

                        foreach($last_comments as $comment)
                        {
                            echo '<ul>';
                            echo '<li>&mdash;'.html::anchor('post/'.$comment->post_url.'-'.$comment->post_id, mb_substr($comment->text, 0, 20).'...').'</li>';
                            echo '</ul>';
                        }

                    ?>
                </ul>
            </div>
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
    </body>
</html>