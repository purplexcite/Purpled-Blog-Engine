<?php echo form::open('admin/comments/search') ?>

<b>Найти комментарии по ID сообщения:</b> <?php echo form::input('id', (!empty($_POST['id']) ? $_POST['id'] : '')).' '.form::submit('submit', 'Найти') ?>

<?php echo form::close() ?>

<?php

    if(!empty($comments))
    {
        echo form::open('admin/comments/edit');
        echo form::submit('submit', 'Принять изменения').'<p>';

        foreach($comments as $comment)
        {

?>

<table>
    <tr>
        <td>Автор:</td>
        <td><?php echo form::input('username[]', $comment->username) ?></td>
    </tr>
    <tr>
        <td>URL:</td>
        <td><?php echo form::input('url[]', $comment->url) ?></td>
    </tr>
    <tr>
        <td colspan="2">
            Текст:
            <br>
            <?php echo form::textarea('text[]', $comment->text) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">Удалить? <?php echo form::checkbox('delete[]', $comment->id).form::hidden('id[]', $comment->id) ?></td>
    </tr>
</table>
<p>

<?php

        }

        echo '<p>'.form::submit('submit', 'Принять изменения');
        echo form::close();
    }

?>