<?php defined('SYSPATH') or die('No direct script access.'); ?>

<div class="menu">
    <div class="menu_text">
        <div class="hello">&mdash; Привет, <b><?php echo $login ?></b>!&nbsp;</div>
        <div class="options">
            <b>Управление:</b>&nbsp;
            <?php echo html::anchor('admin/posts/new', 'Написать сообщение') ?>&nbsp;-&nbsp;
            <?php echo html::anchor('admin/users', 'Пользователи') ?>&nbsp;-&nbsp;
            <?php echo html::anchor('admin/categories', 'Категории') ?>&nbsp;-&nbsp;
            <?php echo html::anchor('admin/posts', 'Сообщения') ?>&nbsp;-&nbsp;
            <?php echo html::anchor('admin/comments', 'Комментарии') ?>&nbsp;-&nbsp;
            <?php echo html::anchor('admin/logout', 'Выход') ?>
        </div>
    </div>
</div>
<div class="manage">
    <div class="title">
        <?php
        
            if(!empty($category))
            {
                switch($category)
                {
                    case 'users':
                        echo 'Пользователи';
                        
                        break;
                    case 'categories':
                        echo 'Категории';
                        
                        break;
                    case 'posts':
                        echo 'Сообщения';
                    
                        break;
                    case 'comments':
                        echo 'Комментарии';
                    
                        break;
                    default:
                        echo 'Выберите категорию выше';
                }
            }
        
        ?>
    </div>
    <?php echo !empty($page) ? $page : '' ?>
</div>