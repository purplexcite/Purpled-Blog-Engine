<div class="content_message">
    <div class="content_title"><b>&laquo;<?php echo $title ?>&raquo; &mdash; <?php echo $posted ?>, <?php echo $author ?></b></div>
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
                    echo '<div class="comment_user"><i>'.(!empty($comment->url) ? html::anchor($comment->url, $comment->username) : $comment->username).'</i></div>';
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
            <tr>
                <td><b>Имя:</b></td>
                <td><?php echo form::input('username') ?></td>
            </tr>
            <tr>
                <td><b>Сайт:</b></td>
                <td><?php echo form::input('url') ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Текст:</b><br>
                    <?php echo form::textarea('text') ?>
                </td>
            </tr>
            <tr>
                <td colspan="2"><?php echo html::image('captcha/default') ?></td>
            </tr>
            <tr>
                <td><b>Какой текст с изображения выше:</b></td>
                <td><?php echo form::input('captcha') ?></td>
            </tr>
            <tr>
                <td colspan="2"><?php echo form::submit('submit', 'Отправить новый комментарий') ?></td>
            </tr>
        </table>
        <p>

        <?php

            }

        ?>