<div class="content_message">
<<<<<<< HEAD
    <div class="content_title"><h1>&laquo;<?php echo $title ?>&raquo; &mdash; <?php echo $posted ?>, <?php echo $author ?></h1></div>
=======
    <div class="content_title"><b><?php echo $title ?>, создано <?php echo $posted ?> неким <?php echo $author ?></b></div>
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c
    <div class="content_text"><?php echo nl2br($text) ?></div>
</div>
<?php echo !empty($comments_count) ? '<div class="content_title">Комментарии ('.$comments_count.')</div>': ''; ?>
    <div class="comment">
        <?php

            $allow_comment;
            
            if($comments->count() != 0)
            {
                foreach($comments as $comment)
                {
<<<<<<< HEAD
                    echo '<div class="comment_user" id="'.$comment->id.'"><i>'.(!empty($comment->url) ? html::anchor($comment->url, $comment->username) : $comment->username).'</i></div>';
=======
                    echo '<div class="comment_user"><i>'.(!empty($comment->url) ? html::anchor($comment->url, $comment->username) : $comment->username).'</i></div>';
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c
                    echo '<div class="comment_message">'.nl2br($comment->text).'</div>';
                }
            }

            if($comments_count >= 0)
            {
                echo form::open('add/'.$id, array(
                            'method' => 'post',
                            ));

        ?>
    </div>
        <div class="content_title">Новый комментарий</div>
        <p>
        <?php echo !empty($errors) ? $errors : ''; ?>
        <p>
<<<<<<< HEAD
        <table align="center">
            <?php
            
                $username = Auth::instance()->get_user()->username;
                
                if(!empty($username))
                {
                    echo form::hidden('username', $username);
                    echo form::hidden('url', 'http://'.$_SERVER['HTTP_HOST']);
            ?>
            
            <tr>
                <td>Привет, <b><?php echo $username ?></b>!</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
               
            <?php
                }
                else {
                    $c_username = Cookie::get('comment_username');
                    $c_url = Cookie::get('comment_url');
            
            ?>
            <tr>
                <td><b>Имя:</b></td>
                <td><?php echo form::input('username', (!empty($c_username) ? $c_username : '')) ?></td>
            </tr>
            <tr>
                <td><b>Сайт:</b></td>
                <td><?php echo form::input('url',  (!empty($c_url) ? $c_url : '')) ?></td>
            </tr>
            <?php
            
                }
            
            ?>
=======
        <table valign="left">
            <tr>
                <td><b>Имя:</b></td>
                <td><?php echo form::input('username') ?></td>
            </tr>
            <tr>
                <td><b>Сайт:</b></td>
                <td><?php echo form::input('url') ?></td>
            </tr>
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c
            <tr>
                <td colspan="2">
                    <b>Текст:</b><br>
                    <?php echo form::textarea('text') ?>
                </td>
            </tr>
<<<<<<< HEAD
            <?php
            
                if(empty($username))
                {
            
            ?>
=======
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c
            <tr>
                <td colspan="2"><?php echo html::image('captcha/default') ?></td>
            </tr>
            <tr>
<<<<<<< HEAD
                <td><b>Капча:</b></td>
                <td><?php echo form::input('captcha') ?></td>
            </tr>
            <?php
            
                }
            
            ?>
            <tr>
                <td colspan="2"><?php echo form::submit('submit', 'Отправить новый комментарий') ?></td>
            </tr>
        </table>
        <p>
=======
                <td><b>Текст изображения:</b></td>
                <td><?php echo form::input('captcha') ?></td>
            </tr>
            <tr>
                <td colspan="2"><?php echo form::submit('submit', 'Отправить') ?></td>
            </tr>
        </table>
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c

        <?php

            }

        ?>