<?php header('Content-type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" ?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo base_url();?></loc>
    </url>
 <?php
if(!empty($cms)){
 foreach($cms as $url) { ?>
    <url>
        <loc><?php echo base_url().$url->page_slug; ?></loc>
    </url>
    <?php } }
    if(!empty($hotels)){
    foreach($hotels as $h) { ?>
    <url>
        <loc><?php echo base_url()."hotels/".$h->hotel_slug; ?></loc>
    </url>
    <?php } }
    if(!empty($cars)){
    foreach($cars as $car) { ?>
    <url>
        <loc><?php echo base_url()."cars/".$car->car_slug; ?></loc>
    </url>
    <?php } }
    if(!empty($tours)){
    foreach($tours as $tslug) { ?>
    <url>
        <loc><?php echo base_url()."tours/".$tslug->tour_slug; ?></loc>
    </url>
    <?php } } ?>

</urlset>

