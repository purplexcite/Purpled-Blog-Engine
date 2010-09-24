<?php

        echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\r\n";
        echo "<rss version=\"2.0\">\r\n";
        echo "<channel>\r\n";
        echo "<title>".htmlspecialchars($title)."</title>\r\n";
        echo "<link>http://".$_SERVER['HTTP_HOST']."</link>\r\n";
        echo "<description>".htmlspecialchars($description)."</description>\r\n\r\n";

            foreach($feed as $entry)
            {
                echo "\r\n<item>\r\n";

                echo "<title>".htmlspecialchars($entry['title'])."</title>\r\n";
                echo "<link>http://".$_SERVER['HTTP_HOST']."/post/".$entry['url']."-".$entry['id']."</link>\r\n";
                echo "<description><![CDATA[\"".stripslashes($entry['content'])."\"]]></description>\r\n";
                echo "<pubDate>".$entry['posted']."</pubDate>\r\n";

                echo "</item>\r\n\r\n";
            }

    echo "</channel>\r\n";
    echo "</rss>\r\n";