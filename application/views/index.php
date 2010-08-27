        <?php

            if(!empty($categories) AND $categories->count() != 0) {

        ?>

        <div class="content_title"><b>Второстепенные категории</b></div>
            <ul>

        <?php
        
                foreach($categories as $category)
                {
                    echo '<li>'.html::anchor('category/'.$category->url.'-'.$category->id, $category->name).'</li>';
                }
            }

        ?>
            
            </ul>
        
<div class="content_title"><b>Сообщения</b></div>
    <div class="pagination"><?php echo $pagination ?></div>
    <ul>
        <?php
        
            if(!empty($posts) AND $posts->count() != 0)
            {
                $model = new Model_Comment;

                foreach($posts as $post)
                {
                    echo '<li><h3>&laquo;'.$post->title.'&raquo; &mdash; '.$post->posted.', '.$post->username.'</h3></li>';
                    echo '<li>'.nl2br(mb_substr($post->content, 0, 25)).'...</li>';
                    echo '<li>&nbsp;</li>';
                    echo '<li>'.($post->allowcomment == 1 ? '<i>Комментариев: '.$model->get_count($post->id).'</i>' : '<i>Комментирование запрещено</i>').'</li>';
                    echo '<li>'.html::anchor('post/'.$post->url.'-'.$post->id, 'Читать далее').'</li>';
                    echo '<li>&nbsp;</li>';
                }
            }
            else {
                echo 'Нет сообщений';
            }

        ?>
    </ul>
    <div class="pagination"><?php echo $pagination ?></div>