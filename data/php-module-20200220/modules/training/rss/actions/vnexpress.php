<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 13/02/2020
 * Time: 09:09 AM
 */

$url_rss = 'https://vnexpress.net/rss/tin-moi-nhat.rss';
$rss = @simplexml_load_file($url_rss, null, LIBXML_NOCDATA);
if (isset($rss->channel)) {
    $new_feeds = $rss->channel->item;
} else {
    die('<div class="col-lg-12 mt-2"><h3>Đang có lỗi xảy ra, bạn vui lòng thử lại sau.</h3></div>');
}
?>
<div class="col-lg-12 mt-2">
    <h3><?php echo $rss->channel->title ?></h3>
    <span><?php echo $rss->channel->pubDate ?></span>
</div>
<div class="col-lg-12">
    <?php foreach ($new_feeds as $new_feed) : $item = (array)$new_feed; ?>
        <div class="media rss-new-feed pt-3 pb-3">
            <?php echo $item['description'] ?></a>
        </div>
    <?php endforeach; ?>
}
</div>