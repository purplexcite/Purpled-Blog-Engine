<div class="content_message">
    <div class="content_title"><h1>&laquo;<?php echo $title ?>&raquo; &mdash; <?php echo $posted ?>, <?php echo $author ?></h1></div>
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
                    echo '<div class="comment_user" id="'.$comment->id.'"><i>'.(!empty($comment->url) ? html::anchor($comment->url, $comment->username) : $comment->username).'</i></div>';
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
            <tr>
                <td colspan="2">
                    <b>Текст:</b><br>
                    <?php echo form::textarea('text') ?>
                </td>
            </tr>
            <?php
            
                if(empty($username))
                {
            
            ?>
            <tr>
                <td colspan="2"><?php echo html::image('captcha/default') ?></td>
            </tr>
            <tr>
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

        <?php

            }

        ?>