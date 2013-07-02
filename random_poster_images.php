<?php
function getRandomImage($path, $img, $num_want) {
    $img = array();
//    echo '<pre>'; print_r( getImagesList($path)); echo '</pre>';
    if ( $list = getImagesList($path) ) {
       while (count($img)<$num_want) {
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
            if ( preg_match("/(\.gif|\.jpg|\.png)$/", $img_file) ) {
                $images[$ctr] = $img_file;
                $ctr++;
            }
        }
        closedir($img_dir);
        return $images;
    } 
    return false;
}


?>
