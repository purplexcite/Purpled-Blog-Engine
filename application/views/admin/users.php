<b>Добавить нового пользователя</b>
<p>

<?php echo form::open('admin/users/new') ?>

<table align="center">
    <tr>
        <td>Логин:</td>
        <td><?php echo form::input('new_login') ?></td>
    </tr>
    <tr>
        <td>Пароль:</td>
        <td><?php echo form::password('new_password') ?></td>
    </tr>
    <tr>
        <td colspan="2"><?php echo form::submit('submit', 'Добавить нового пользователя') ?></td>
    </tr>
</table>

<?php echo form::close() ?>

<b>Пользователи в системе</b>
<p>

<?php echo form::open('admin/users/edit') ?>
<?php echo form::submit('submit', 'Применить изменения') ?>

<p>

<table align="center">
    <tr>
        <td><b>Логин</b></td>
        <td><b>Новый пароль</b></td>
        <td><b>Удалить</b></td>
    </tr>

    <?php

        foreach($users as $user)
        {
            echo '<tr align="center">';
            echo '<td>'.form::input('username[]', $user->username).form::hidden('uid[]', $user->id).'</td>';
            echo '<td>'.form::password('password[]').'</td>';
            echo '<td>'.form::checkbox('delete[]', $user->id).'</td>';
            echo '</tr>';
        }

    ?>

</table>

<p>

<?php echo form::submit('submit', 'Применить изменения') ?>
<?php echo form::close() ?>