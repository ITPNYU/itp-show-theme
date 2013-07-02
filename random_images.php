<div id="img_layer">
<img src="<?php bloginfo('template_url');?>/images/topImg.jpg/<?>" />
</div>

?>

<?
/*
$path_to_images = (TEMPLATEPATH . '/images/fishpics');  
$default_img = "fish1.jpg"; 
$img = getRandomImage($path_to_images, $default_img,5);
#echo '<pre>'; print_r($img); echo '</pre>';

?>
 <div id="img_layer">
<?php 
  foreach ($img as $i) { ?>
        <img src="<?php bloginfo('template_url');?>/images/fishpics/<?=$i?>" />
<? } ?>

 </div>
<?php
function getRandomImage($path, $img, $num_want) {
    $img = array();
   // echo '<pre>'; print_r( getImagesList($path)); echo '</pre>';
    if ( $list = getImagesList($path) ) {
       while (count($img)<4) {
         mt_srand( (double)microtime() * 1000000 );
         $num = array_rand($list);
         $found = array_search($list[$num], $img);
	 if ($found===null || $found===false) {
	        $img[] = $list[$num];
	 } 
       } 
    } 
    return $img;
}

function getImagesList($path) {
     $ctr = 0;
    if ( $img_dir = @opendir($path) ) {
        while ( false !== ($img_file = readdir($img_dir)) ) {
            // can add checks for other image file types here
            if ( preg_match("/(\.gif|\.jpg)$/", $img_file) ) {
                $images[$ctr] = $img_file;
                $ctr++;
            }
        }
        closedir($img_dir);
        return $images;
    } 
    return false;
}*/


?>
