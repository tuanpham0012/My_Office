<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 13/02/2020
 * Time: 09:10 AM
 */

$url_rss = 'https://dantri.com.vn/trangchu.rss';

$html = @file_get_contents($url_rss);
$html = str_replace('encoding="utf-16"', 'encoding="utf-8"', $html);
$rss = @simplexml_load_string($html);
if ($rss->channel) {
    $new_feeds = $rss->channel->item;
} else {
    die('<div class="col-lg-12 mt-2"><h3>Đang có lỗi xảy ra, bạn vui lòng thử lại sau.</h3></div>');
}
?>
<div class="col-lg-12 mt-2">
    <h3><?php echo $rss->channel->title ?></h3>
    <span><?php echo $rss->channel->lastBuildDate ?></span>
</div>
<div class="col-lg-12">
    <?php foreach ($new_feeds as $new_feed) : $item = (array)$new_feed; ?>
        <div class="media pt-3 pb-3">
            <img src="public/images/lg_dantri_dktop.svg" class="align-self-start mr-3" alt="Logo dantri" style="max-width: 150px">
            <div class="media-body">
                <h5 class="mt-0"><?php echo $item['title'] ?></h5>
                <p><?php echo $item['description'] ?></p>
            </div>
        </div>
    <?php endforeach; ?>
    }
</div>