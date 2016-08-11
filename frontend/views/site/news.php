<?php
$this->title = 'News';
$this->params['breadcrumbs'][] = ['label' => 'Hauptmenü', 'url' => ['tiles']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-news">
    <?php
// var_dump($news[0]->URL);
// die();

    $rss = new DOMDocument();

    try {
        $rss->load($news[0]->URL);


        $feed = array();
        foreach ($rss->getElementsByTagName('item') as $node) {
            $item = array(
                'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
                'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
            );
            array_push($feed, $item);
        }
        $limit = 8;
        for ($x = 0; $x < $limit; $x++) {
            $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
            $description = $feed[$x]['desc'];
            $date = date('l F d, Y G:H:i', strtotime($feed[$x]['date']));
            ?>	

            <div class="col-sm-12 news">
                <div class="thumbnail tile-news tile-concrete">
                    <p><strong><?= $title ?></strong><br />
                        <small><em>Posted on <?= $date ?></em></small></p>
                    <p><?= $description ?></p>
                </div>
            </div>


        <!--                echo '<p><strong><a title="'.$title.'">'.$title.'</a></strong><br />';
        echo '<small><em>Posted on '.$date.'</em></small></p>';
        echo '<p>'.$description.'</p>';-->
        <?php
        }
    } catch (Exception $e) {
        echo 'RSS Feed konnte nicht aufgerufen werden. <br/> Fehler: ', $e->getMessage(), "\n";
    }
    ?>
</div>

<style>
    .tile-news{
        width: 100%;
        height: 10%;
        color: white;
        background-color: #34495e;
    }
    .site-news .site-welcome{
        padding-left: 0px !important;
        padding-right: 0px !important;
    }
    .news{
        padding: 0;
        font-size: 15px;
    }
</style>

