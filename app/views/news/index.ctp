<?php
        echo "<h1>Changelog FishEye:</h1>";
        // Options de base
        $url_flux_rss = 'http://svn.openqa.org/fisheye/changelog/~rss/bromine/branches/rss.xml';
        $limite       = 10; // nombre d'actus à afficher
        
        // options lastRSS
        $rss->cache_dir   = './cache'; // dossier pour le cache
        $rss->cache_time  = 3600;      // fréquence de mise à jour du cache (en secondes)
        $rss->date_format = 'd/m - Y';     // format de la date (voir fonction date() pour syntaxe)
        $rss->CDATA       = 'content'; // on retire les tags CDATA en conservant leur contenu
        
        $rss->channeltags = array ('title', 'link', 'description', 'language', 'copyright', 'managingEditor', 'webMaster', 'rating', 'docs');
        $rss->itemtags = array('title', 'link', 'description', 'author', 'category', 'comments', 'enclosure', 'guid', 'pubDate', 'source');
        $rss->imagetags = array('title', 'url', 'link', 'width', 'height');
        $rss->textinputtags = array('title', 'description', 'name', 'link');
        
        
        // lecture du flux
        if ($rs = $rss->get($url_flux_rss))
        
        {
        if ($rs['items_count'] < $limite) {$limite = $rs['items_count'];} 
        
          for($i=0;$i<$limite;$i++)
          {
            // affichage de chaque actu
            echo '<strong>'.$rs['items'][$i]['pubDate'].'</strong> &middot; <a href="'.$rs['items'][$i]['link'].'">'.$rs['items'][$i]['title'].'</a><br />';
          }
        }
        else 
        {
          die ('Flux RSS non trouvé');
        }
        
        echo "<h1>Jira:</h1>";

        // Options de base
        $url_flux_rss = 'http://jira.openqa.org/sr/jira.issueviews:searchrequest-xml/temp/SearchRequest.xml?&&pid=10171&fixfor=10640&sorter/field=issuekey&sorter/order=DESC&tempMax=100&reset=true&decorator=none';
        $limite       = 10; // nombre d'actus à afficher
        
        // options lastRSS
        $rss->cache_dir   = './cache'; // dossier pour le cache
        $rss->cache_time  = 3600;      // fréquence de mise à jour du cache (en secondes)
        $rss->date_format = 'd/m - Y';     // format de la date (voir fonction date() pour syntaxe)
        $rss->CDATA       = 'content'; // on retire les tags CDATA en conservant leur contenu
        
        $rss->channeltags = array ('title', 'link', 'description', 'language', 'copyright', 'managingEditor', 'webMaster', 'lastBuildDate', 'rating', 'docs');
        $rss->itemtags = array('title', 'link', 'description', 'author', 'category', 'comments', 'enclosure', 'guid', 'source');
        $rss->imagetags = array('title', 'url', 'link', 'width', 'height');
        $rss->textinputtags = array('title', 'description', 'name', 'link');
        
        // lecture du flux
        if ($rs = $rss->get($url_flux_rss))
        
        {
        if ($rs['items_count'] < $limite) {$limite = $rs['items_count'];} 
        
          for($i=0;$i<$limite;$i++)
          {
            // affichage de chaque actu
            echo '<a href="'.$rs['items'][$i]['link'].'">'.$rs['items'][$i]['title'].'</a><br />';
          }
        }
        else 
        {
          die ('Flux RSS non trouvé');
        }
?>
