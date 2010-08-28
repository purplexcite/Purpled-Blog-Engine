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

                // Function from http://wap.blog.infan.ru/alex/1/16/?B=493
                function close_tags(&$s, $tags)
                {
                    $p = 0;
                    $open = array();

                    while (($p = strpos($s, '<', $p)) !== false) {
                        if (preg_match("~^<(/?)([a-z\d]+)\b[^>]*>~i", substr($s, $p), $m)) {
                        $tag = strtolower($m[2]);

                        if (preg_match("/^($tags)$/", $tag)) {
                            if ($m[1]) { // </tag>
                            if ($open[$tag] > 0)
                                $open[$tag]--;
                            else { // удалить лишний закрывающий тег
                                $s = substr_replace($s, '', $p, strlen($m[0]));
                                continue;
                            }
                            }
                            else
                            $open[$tag]++;
                        }

                        $p += strlen($m[0]);
                        }
                        else
                        $p++;
                    }

                    foreach ($open as $tag => $p)
                        if ($p > 0)
                        $s .= "</".$tag.">";
                    }

                foreach($posts as $post)
                {
                    $message = nl2br(mb_substr($post->content, 0, 25));

                    close_tags($message, '(b|u|i)');

                    echo '<li><h3>&laquo;'.$post->title.'&raquo; &mdash; '.$post->posted.', '.$post->username.'</h3></li>';
                    echo '<li>'.$message.'...</li>';
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