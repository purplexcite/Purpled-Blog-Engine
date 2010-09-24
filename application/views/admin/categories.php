<b>Добавить новую категорию</b>
<p>

<?php echo form::open('admin/categories/new') ?>

<p>
<table>
    <tr>
        <td>Имя категории:</td>
        <td><?php echo form::input('new_name', '', array('onkeyup' => 'translit(\'new_name\', \'new_url\');')) ?></td>
    </tr>
    <tr>
        <td>URL</td>
        <td><?php echo form::input('new_url') ?></td>
    </tr>
    <tr>
        <td>В категорию:</td>
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

                $cats = array('Новая директория');

                if(!empty($categories))
                {
                    parse_cats($categories[0], $cats);
                }

                echo form::select('new_category', $cats);

            ?>
        </td>
    </tr>
    <tr>
        <td><?php echo form::submit('submit', 'Добавить категорию') ?></td>
    </tr>
</table>

<?php echo form::close() ?>

<?php

    function parse_array($arr)
    {
        foreach($arr as $key => $value)
        {
            $db = DB::select()
                    ->from('categories')
                    ->where('id', '=', $key)
                    ->execute();

            echo '<ul><li>';
            echo '<b>Название:</b> '.form::input('name[]', $db[0]['name'], array('onkeyup' => 'translit(\'name[]\', \'url[]\');')).form::hidden('cid[]', $db[0]['id']).'&nbsp;';
            echo '<b>URL:</b> '.form::input('url[]', $db[0]['url']).'&nbsp;';
            echo '<b>Удалить?</b> '.form::checkbox('delete[]', $db[0]['id']);
            echo '</li>';

            if(is_array($value))
            {
                parse_array($value);
            }
            
            echo '</ul>';
        }
    }

    if(!empty($categories))
    {
        echo form::open('admin/categories/edit');
        echo form::submit('submit', 'Применить изменения');

        parse_array($categories[0]);

        echo form::submit('submit', 'Применить изменения');
        echo form::close();
    }

?>