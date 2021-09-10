<?php
//the_post();
$postType = get_post_type();
$filePath = TEMPLATEPATH . '/simgle-' . $postType . '.php';
if(file_exists($filePath)){
	include($filePath);
} else {
	include(TEMPLATEPATH . '/single-template.php');
}

<?php echo wpmidia_get_post_views($post->ID); ?>
?>