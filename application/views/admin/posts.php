<?php echo form::open('admin/posts/search') ?>

<p>

<b>ID сообщения</b>: <?php echo form::input('id', (!empty($_POST['id']) ? $_POST['id'] : '')).' '.form::submit('submit', 'Показать') ?>

<p>

<?php echo form::close() ?>

<?php

    if(!empty($post))
    {
        echo form::open('admin/posts/edit');
?>

<table>
    <tr>
        <td><b>Заголовок:</b></td>
        <td><?php echo form::input('title', $post->title, array('onkeyup' => 'translit(\'title\', \'url\');')) ?></td>
    </tr>
    <tr>
        <td><b>URL:</b></td>
        <td><?php echo form::input('url', $post->url) ?></td>
    </tr>
    <tr>
        <td colspan="2">
            <b>Сообщение:</b>
            <br>
            <?php echo form::textarea('content', $post->content) ?>
        </td>
    </tr>
    <tr>
        <td><b>В категорию:</b></td>
        <td>
            <?php

                function parse_cats($arr, &$new_arr)
                {
                    foreach($arr as $key => $value)
                    {
                        $db = DB::select()
                                ->from('categories')
                                ->where('id', '=', $key)
                                ->execute();

                        $new_arr[$db[0]['id']] = $db[0]['name'];

                        if(is_array($value))
                        {
                            parse_cats($value, $new_arr);
                        }
                    }
                }

                $cats = array();

                parse_cats($categories[0], $cats);

                echo form::select('category', $cats, $post->catid);

            ?>
        </td>
    </tr>
    <tr>
        <td><b>С комментариями?</b></td>
        <td><?php echo form::checkbox('allowcomment', NULL, ($post->allowcomment == 1 ? TRUE : FALSE)) ?></td>
    </tr>
    <tr>
        <td><b>Удалить сообщение!</b></td>
        <td><?php echo form::checkbox('delete', $post->id) ?></td>
    </tr>
    <tr>
        <td colspan="2" align="right"><?php echo form::hidden('id', $post->id).form::submit('submit', 'Применить изменения') ?></td>
    </tr>
</table>
    
<?php

        echo form::close();
    }

?>