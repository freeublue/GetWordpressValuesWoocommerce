<?php

$path = $_SERVER['DOCUMENT_ROOT'];

include_once $path . '/wp-config.php';
include_once $path . '/wp-load.php';
include_once $path . '/wp-includes/wp-db.php';
include_once $path . '/wp-includes/pluggable.php';
include_once $path . '/wp-includes/media.php';
include_once $path . '/wp-includes/post-thumbnail-template.php';



$args = array( 'post_type' => 'product', 'product_status' => 'publish', 'posts_per_page' => -1, 'orderby' => 'meta_id', 'order' => 'DESC' );
$loop = new WP_Query( $args );

while ( $loop->have_posts() ) : $loop->the_post(); global $product;
$quant = $product->get_stock_quantity(); 
if($quant > 0) { 
$postId = $loop->post->ID; 
$image_url = wp_get_attachment_url(get_post_thumbnail_id($loop->post->ID)); 

$pic = get_post_thumbnail_id($loop->post->ID);
$link = get_permalink( $loop->post->ID );
$tiq = get_the_title(); 
$name = preg_replace("/[^a-zA-Z0-9\s]/", "", $tiq);
$price1 = $product->get_price();
$price = str_replace('R', ' ', $price1);
$sku = $product->get_sku(); 
$cate = $product->get_categories(); 
$category = explode(',', $cate);
$cate1 = $category[0];
$cate2 = $category[1];
$cate3 = $category[2];

$cate1 = preg_replace('#<a.*?>([^>]*)</a>#i', '$1', $cate1);
$cate2 = preg_replace('#<a.*?>([^>]*)</a>#i', '$1', $cate2);
$cate3 = preg_replace('#<a.*?>([^>]*)</a>#i', '$1', $cate3);
$cate1 = preg_replace("/[^a-zA-Z0-9\s]/", "", $cate1);
$cate2 = preg_replace("/[^a-zA-Z0-9\s]/", "", $cate2);
$cate3 = preg_replace("/[^a-zA-Z0-9\s]/", "", $cate3);
$categories = $cate1 . " > " . $cate2 . " > " . $cate3;
echo "$categories<br>";
echo "price $price1<br>";
echo "link $link<br>";

$quant = $product->get_stock_quantity(); 
$weight = $product->get_weight(); 
$height = $product->get_height(); 
$width = $product->get_width(); 
$length = $product->get_length();
$dimensions = $product->get_dimensions();
$salePrice = $product->get_sale_price();
$img = $product->get_image_id();
echo "image $image_url<br>";


 } 
endwhile; 


?>
