<?php echo form::open('admin/posts/new') ?>

<table>
    <tr>
        <td><b>Заголовок:</b></td>
        <td><?php echo form::input('title', '', array('onkeyup' => 'translit(\'title\', \'url\');')) ?></td>
    </tr>
    <tr>
        <td><b>URL:</b></td>
        <td><?php echo form::input('url') ?></td>
    </tr>
    <tr>
        <td colspan="2">
            <b>Сообщение:</b>
            <br>
            <?php echo form::textarea('content') ?>
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

                echo form::select('category', $cats);

            ?>
        </td>
    </tr>
    <tr>
        <td><b>С комментариями?</b></td>
        <td><?php echo form::checkbox('allowcomment') ?></td>
    </tr>
    <tr>
        <td colspan="2" align="right"><?php echo form::submit('submit', 'Добавить новое сообщение') ?></td>
    </tr>
</table>

<?php echo form::close() ?>