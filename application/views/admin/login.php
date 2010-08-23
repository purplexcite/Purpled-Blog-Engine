<?php echo form::open('admin/login') ?>
<table>
    <tr>
        <td><b>Логин:</b></td>
        <td><?php echo form::input('username') ?></td>
    </tr>
    <tr>
        <td><b>Пароль:</b></td>
        <td><?php echo form::password('password') ?></td>
    </tr>
    <tr>
        <td><b>Капча:</b></td>
        <td><?php echo form::input('captcha') ?></td>
    </tr>
    <tr>
        <td colspan="2" align="right"><?php echo html::image('captcha/default') ?></td>
    </tr>
    <tr>
        <td><b><?php echo form::checkbox('remember') ?> Запомнить</b></td>
        <td align="center"><?php echo form::submit('submit', 'Войти') ?></td>
    </tr>
</table>
<?php echo form::close() ?>