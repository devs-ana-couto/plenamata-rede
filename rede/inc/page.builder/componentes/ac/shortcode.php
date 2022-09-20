<?php
/*
 * Page Builder Componentes
 * Iframe
*/

function ac_shortcode($obj_id,$obj = null,$block=0,$echo = true){
	$short = get_sub_field('gd-el-shortcode');

	$generate_element = do_shortcode($short);

	if($echo){
		echo do_shortcode($short);
	}

	return $generate_element;
}