<?php
/*
 * Page Builder Componentes
*/
///require_once('componentes/ac/banner.home.php');
// require_once('componentes/ac/slider.header.php');
require_once('componentes/ac/form.iframe.php');
require_once('componentes/ac/about.video.php');
require_once('componentes/ac/members.php');
require_once('componentes/ac/tools.kit.php');
require_once('componentes/ac/master.class.php');
require_once('componentes/ac/share.php');
// require_once('componentes/ac/calendar.php');
require_once('componentes/ac/shortcode.php');


function page_bulder_init($obj_id, $obj = null, $echo = true)
{
    $return = array();
    $block = 0;
    // check if the flexible content field has rows of data
    if (have_rows('gd-elements', $obj_id)):
        // if ($echo) echo '<div id="pb-generated-' . $obj_id . '">';
        // loop through the rows of data
        while (have_rows('gd-elements', $obj_id)) : the_row();
            $layout = get_row_layout();
            switch ($layout) {
                case 'gd-header-slider':
                    $return[$layout] = pb_ac_slier_header($obj_id, $obj, $block, $echo);
                    break;
                case 'gd-element-form-fixed':
                    $return[$layout] = pb_ac_form_frame($obj_id, $obj, $block, $echo);
                    break;
                case 'gd-element-about-video':
                    $return[$layout] = pb_ac_about_video($obj_id, $obj, $block, $echo);
                    break;
                case 'gd-members':
                    $return[$layout] = pb_ac_members($obj_id, $obj, $block, $echo);
                    break;
                case 'gd-tools-kit':
                    $return[$layout] = pb_ac_toolskit($obj_id, $obj, $block, $echo);
                    break;
                case 'gd-master-class':
                    $return[$layout] = pb_ac_master_class($obj_id, $obj, $block, $echo);
                    break;
                case 'gd-share':
                    $return[$layout] = pb_ac_share($obj_id, $obj, $block, $echo);
                    break;
                case 'gd-calendar':
                    $return[$layout] = pb_ac_calendar($obj_id, $obj, $block, $echo);
                    break;
                case 'gd-ac-shortcode':
                    $return[$layout] = ac_shortcode($obj_id, $obj, $block, $echo);
                    break;
            }
            $block++;
        endwhile;
        // if ($echo) echo '</div>';
        return $return;
    else :

        // no layouts found
        return $return;

    endif;
}


function set_margin_personalized($margins, $div_el)
{
    if (!is_array($margins)) {
        return "";
    }

    $t_margin_and_padding = "
		$div_el{margin-top:{mtm}px; margin-bottom:{mbm}px;}
		$div_el .wrapper{padding-top:{ptm}px; padding-bottom:{pbm}px;}

		@media (min-width: 992px) {
			$div_el{margin-top:{mt}px; margin-bottom:{mb}px;}
			$div_el .wrapper{padding-top:{pt}px; padding-bottom:{pb}px;}
		}";

    if (empty($margins[0])) {
        array_shift($margins);
    }


    $t_margin_and_padding = str_replace(
        array('{mt}', '{mb}', '{pt}', '{pb}', '{mtm}', '{mbm}', '{ptm}', '{pbm}'),
        $margins,
        $t_margin_and_padding
    );

    return $t_margin_and_padding;
}


function set_background($div_el, $background_color = '', $background_image = '', $mask = false)
{
    $t_color_background = "";
    if (!empty($background_color)) {
        $t_color_background = "$div_el{background:$background_color;}";
    }

    if (!empty($background_image)) {
        $t_color_background = "$div_el{background:url('" . $background_image['url'] . "') center center $background_color; background-attachment:fixed; background-size:cover; background-repeat:no-repeat; }";
    }

    if ($mask) {
        $t_color_background .= "$div_el .wrapper{background-color: rgba(0,0,0,0.5); }";
    }


    return $t_color_background;
}

function remove_mask($div_el, $remove_mask)
{
    if ($remove_mask) {
        $t_color_background = "$div_el .wrapper{background:none; }";
    }

    return $t_color_background;
}

function set_background_space($div_el, $background_color = '', $background_image = '', $mask = false)
{
    $t_color_background = "";
    if (!empty($background_color)) {
        $t_color_background .= "$div_el{background:$background_color;}";
    }

    if (!empty($background_image)) {
        $t_color_background .= "$div_el .wrapper-bg{background:url('" . $background_image['url'] . "') center center $background_color;  background-size:cover; background-repeat:no-repeat; }";
    }

    return $t_color_background;
}

function set_background_commom($div_el, $background_color = '', $background_image = '', $mask = false)
{
    $t_color_background = "";
    if (!empty($background_color)) {
        $t_color_background .= "$div_el{background:$background_color;}";
    }

    if (!empty($background_image)) {
        $t_color_background .= "$div_el .container{background-image:url('" . $background_image['url'] . "'); background-color:$background_color; }";
    }

    return $t_color_background;
}


function set_background_advanced($div_el, $background_color = '', $background_color2 = '', $background_image = '', $mask = false)
{

    $t_color_background = "";
    if (!empty($background_color) && empty($background_color2)) {
        $t_color_background .= "$div_el{background:$background_color;}";
    }

    if (!empty($background_color) && !empty($background_color2)) {
        $rgb_color_1 = implode(",", hexToRgb($background_color));
        $rgb_color_2 = implode(",", hexToRgb($background_color2));

        $t_color_background .= "$div_el{
			background: rgb($rgb_color_1); /* Old browsers */
			background: -moz-linear-gradient(top,  rgba($rgb_color_1) 50%, rgba($rgb_color_2,1) 50%); /* FF3.6-15 */
			background: -webkit-linear-gradient(top,  rgba($rgb_color_1) 50%,rgba($rgb_color_2,1) 50%); /* Chrome10-25,Safari5.1-6 */
			background: linear-gradient(to bottom,  rgba($rgb_color_1) 50%,rgba($rgb_color_2,1) 50%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='$background_color', endColorstr='$background_color2',GradientType=0 ); /* IE6-9 */
		}";
    }

    if (!empty($background_image)) {
        $t_color_background .= "$div_el .wrapper-bg{background:url('" . $background_image['url'] . "') center center $background_color;  background-size:cover; background-repeat:no-repeat; }";
    }

    return $t_color_background;


}


function set_background_mask($div_el, $background_color = '', $background_image = '')
{
    $t_color_background = "";
    if (!empty($background_color)) {
        $t_color_background = "$div_el{background:$background_color;}";
    }

    if (!empty($background_image)) {
        $t_color_background .= "$div_el .bg{background:url('" . $background_image['url'] . "') center center; background-repeat:no-repeat; width: 100%;    min-height: 110vh;    height: 100%;    background-size: cover;    position: absolute;    top: 0px;    left: 0px;    background-blend-mode: multiply;    opacity: 0.1; }";
    }


    return $t_color_background;
}

function set_font_color($div_el, $font_color)
{
    $t_color_font = "";
    if (!empty($font_color)) {
        $t_color_font = "$div_el{ color:$font_color !important;}";
    }

    return $t_color_font;
}


function set_all_font_color($div_el, $font_color)
{
    $t_color_font = "";
    if (!empty($font_color)) {
        $t_color_font = "$div_el, $div_el h1, $div_el h2, $div_el h3, $div_el h4, $div_el h5, $div_el h6, $div_el h7, $div_el p, $div_el span{ color:$font_color !important;}";
    }

    return $t_color_font;
}

function set_button_color($div_el, $color_button = "", $color_background = "")
{
    $t_color_button = "";
    if (!empty($color_button)) {
        $t_color_button = "$div_el{ border: 1px solid $color_button; color: $color_button; background-color:transparent; }
			$div_el:hover{ border: 1px solid $color_background; color: $color_background; background-color:$color_button; }";
    }

    return $t_color_button;
}


function set_section_width($_width)
{
    $container_css = "";
    switch ($_width) {
        case 'full':
            $container_css = "";
            break;
        case 'expanded':
            $container_css = "container";
            break;
        case 'content':
            $container_css = "container content";
            break;
    }
    return $container_css;
}


function set_section_width2($_width)
{
    $container_css = "";
    switch ($_width) {
        case 'full':
            $container_css = "";
            break;
        case 'expanded':
            $container_css = "container-fluid";
            break;
        case 'content':
            $container_css = "container content";
            break;
    }
    return $container_css;
}


function set_col_grid($prefix, $opts = "")
{

    $css = "";

    if (!is_array($opts)) {
        $es = get_sub_field($prefix . 'es');
        $sm = get_sub_field($prefix . 'sm');
        $md = get_sub_field($prefix . 'md');
        $lg = get_sub_field($prefix . 'lg');
        $xl = get_sub_field($prefix . 'xl');
    } else {
        $es = $opts[$prefix . 'es'];
        $sm = $opts[$prefix . 'sm'];
        $md = $opts[$prefix . 'md'];
        $lg = $opts[$prefix . 'lg'];
        $xl = $opts[$prefix . 'xl'];
    }


    if (!empty($es)) {
        $css .= ' col-es-' . $es;
    }
    if (!empty($sm)) {
        $css .= ' col-sm-' . $sm;
    }
    if (!empty($md)) {
        $css .= ' col-md-' . $md;
    }
    if (!empty($lg)) {
        $css .= ' col-lg-' . $lg;
    }
    if (!empty($xl)) {
        $css .= ' col-xl-' . $xl;
    }


    return $css;
}
