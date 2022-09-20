<?php
/**
 *  CARROSSEL HOME
 */

add_action( 'init', 'create_carrosselhome' );
function create_carrosselhome() {
	register_post_type( 'carrosselhome',
	    array(
	      	'labels' => array(
		        'name' =>  'Carrossel Home',
		        'singular_name' =>  'Carrossel Home',
				'add_new' =>  'Adicionar Item',
				'add_new_item' =>  'Adicionar Novo Item',
				'edit_item' =>  'Editar Item',
				'new_item' =>  'Novo Item',
			),
			'public' => true,
			'capability_type' => 'post',
			'menu_icon' => 'dashicons-images-alt',
			'has_archive' => true,
			'rewrite' => array('slug' => 'carrossel-home'),
			'supports' => array( 'title')
		)
	);
}


function carrosselhome_add_campos() {
    add_meta_box( 'carrosselhome_dados','Dados', 'carrosselhome_campos_callback', 'carrosselhome', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'carrosselhome_add_campos' );


function carrosselhome_campos_callback( $post ) {
    wp_nonce_field( 'carrosselhome_campos_save_meta_box_data', 'carrosselhome_campos_meta_box_nonce' );
    $tag = get_post_meta( $post->ID, 'carrosselhome_tag', true );
    $cta_link = get_post_meta( $post->ID, 'carrosselhome_cta_link', true );
    $cta_text = get_post_meta( $post->ID, 'carrosselhome_cta_text', true );
    $img_desk = get_post_meta( $post->ID, 'carrosselhome_img_desk', true );
    $guid_img_desk = ($img_desk!='') ? get_the_guid( $img_desk ) : '';
    $img_mobi = get_post_meta( $post->ID, 'carrosselhome_img_mobi', true );
    $guid_img_mobi = ($img_mobi!='') ? get_the_guid( $img_mobi ) : '';
    echo '<div>';
    echo '<strong>TAG:</strong>';
    echo '<input type="text" name="carrosselhome_tag" id="carrosselhome_tag" value="'.$tag.'" placeholder="TAG" style="width:100%" />';
    echo '</div>';
    echo '<br><hr><br>';
    echo '<div>';
    echo '<strong>CTA:</strong>';
    echo '<input type="text" name="carrosselhome_cta_text" id="carrosselhome_cta_text" value="'.$cta_text.'" placeholder="CTA TEXT" style="width:100%" />';
    echo '<br><br>';
    echo '<input type="text" name="carrosselhome_cta_link" id="carrosselhome_cta_link" value="'.$cta_link.'" placeholder="CTA LINK" style="width:100%" />';
    echo '</div>';
    echo '<br><hr><br>';
    echo '<div">';
    //IMG DESK
    // echo '<input type="file" name="img_desktop" id="img_desktop" style="display:none;" />';
    echo '<div id="img_desktop_espaco" style="cursor:pointer;background-image:url(';
    if ($guid_img_desk!='') echo $guid_img_desk;
    echo ');background-color:#f0f0f0;background-size:contain;background-repeat:no-repeat;width:300px;height:170px;">';
    if ($img_desk=='') {
        echo '<br><br><p style="text-align:center;">Clique <strong>aqui</strong> para adicionar uma imagem para o desktop.</p><br><br>';
    }
    echo '</div><br /><br />';
    echo '<input type="hidden" name="carrosselhome_img_desk" id="carrosselhome_img_desk" value="'.$img_desk.'"  />';
    //IMG MOBI
    // echo '<input type="file" name="img_mobile" id="img_mobile" style="display:none;" />';
    echo '<div id="img_mobile_espaco" style="cursor:pointer;background-image:url(';
    if ($guid_img_mobi!='') echo $guid_img_mobi;
    echo ');background-color:#f0f0f0;background-size:contain;background-repeat:no-repeat;width:140px;height:300px;">';
    if ($img_mobi=='') {
        echo '<br><br><p style="text-align:center;">Clique <strong>aqui</strong> para adicionar uma imagem para o mobile.</p><br><br>';
    }
    echo '</div><br /><br />';
    echo '<input type="hidden" name="carrosselhome_img_mobi" id="carrosselhome_img_mobi" value="'.$img_mobi.'"  />';
    echo '</div>';

    echo '<script>';
    echo '    jQuery(function($){';
    echo '        jQuery("#img_desktop_espaco").on("click", function( event ){';
    // echo '            var clicked = $(this);';
    echo '            var file_frame;';
    echo '            event.preventDefault();';
    echo '            if ( file_frame ) {';
    echo '                file_frame.open();';
    echo '                return;';
    echo '            }';
    echo '            file_frame = wp.media.frames.file_frame = wp.media({';
    echo '                title: jQuery( this ).data( "upload_image" ),';
    echo '                button: {';
    echo '                    text: jQuery( this ).data( "uploader_button_text" )';
    echo '                },';
    echo '                multiple: false';
    echo '            });';
    echo '            file_frame.on( "select", function() {';
    echo '                var attachment = file_frame.state().get("selection").first().toJSON();';
    // echo '                console.log(attachment);';
    echo '                jQuery("#carrosselhome_img_desk").val(attachment.id);';
    echo '                jQuery("#img_desktop_espaco").css("background-image", "url("+attachment.url+")");';
    echo '                jQuery("#img_desktop_espaco").html("");';
    echo '            });';
    echo '            file_frame.open();';
    echo '        });';
    echo '        jQuery("#img_mobile_espaco").on("click", function( event ){';
    // echo '            var clicked2 = $(this);';
    echo '            var file_frame2;';
    echo '            event.preventDefault();';
    echo '            if ( file_frame2 ) {';
    echo '                file_frame2.open();';
    echo '                return;';
    echo '            }';
    echo '            file_frame2 = wp.media.frames.file_frame = wp.media({';
    echo '                title: jQuery( this ).data( "upload_image" ),';
    echo '                button: {';
    echo '                    text: jQuery( this ).data( "uploader_button_text" )';
    echo '                },';
    echo '                multiple: false';
    echo '            });';
    echo '            file_frame2.on( "select", function() {';
    echo '                var attachment2 = file_frame2.state().get("selection").first().toJSON();';
    // echo '                console.log(attachment);';
    echo '                jQuery("#carrosselhome_img_mobi").val(attachment2.id);';
    echo '                jQuery("#img_mobile_espaco").css("background-image", "url("+attachment2.url+")");';
    echo '                jQuery("#img_mobile_espaco").html("");';
    echo '            });';
    echo '            file_frame2.open();';
    echo '        });';
    echo '    });';
    echo '</script>';
    echo '</div>';
}

function carrosselhome_campos_save_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['carrosselhome_campos_meta_box_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['carrosselhome_campos_meta_box_nonce'], 'carrosselhome_campos_save_meta_box_data' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( isset( $_POST['post_type'] )) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }
    $tag = $_POST['carrosselhome_tag'];
    $cta_link = $_POST['carrosselhome_cta_link'];
    $cta_text = $_POST['carrosselhome_cta_text'];
    $img_desk = $_POST['carrosselhome_img_desk'];
    $img_mobi = $_POST['carrosselhome_img_mobi'];

    update_post_meta( $post_id, 'carrosselhome_tag', $tag );
    update_post_meta( $post_id, 'carrosselhome_cta_link', $cta_link );
    update_post_meta( $post_id, 'carrosselhome_cta_text', $cta_text );
    update_post_meta( $post_id, 'carrosselhome_img_desk', $img_desk );
    update_post_meta( $post_id, 'carrosselhome_img_mobi', $img_mobi );
}
add_action( 'save_post', 'carrosselhome_campos_save_meta_box_data' );


if (!function_exists('bloco_carrosselhome')) {
    function bloco_carrosselhome() {
        $args = array (
            'post_type'       => 'carrosselhome',
            'posts_per_page'  => -1,
            'page'            => 1,
            'post_status'     => 'publish',
            'orderby'         => 'menu',
            'order'           => 'ASC',
        );
        $the_query = new WP_Query( $args );
        $dados = array();
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $identif    = $the_query->post->ID;
            $titulo     = get_the_title();
            $tag        = get_post_meta( $identif, 'carrosselhome_tag', true );
            $cta_link   = get_post_meta( $identif, 'carrosselhome_cta_link', true );
            $cta_text   = get_post_meta( $identif, 'carrosselhome_cta_text', true );
            $img_desk   = get_post_meta( $identif, 'carrosselhome_img_desk', true );
            $img_mobi   = get_post_meta( $identif, 'carrosselhome_img_mobi', true );
            $guid_img_desk = ($img_desk!='') ? get_the_guid( $img_desk ) : '';
            $guid_img_mobi = ($img_mobi!='') ? get_the_guid( $img_mobi ) : '';
            // $conteudo   = apply_filters( 'the_content', get_the_content() );
            // $conteudo   = str_replace( ']]>', ']]&gt;', $conteudo );
            // $resumo     = get_the_content();
            // $link       = get_permalink();
            // $dia        = get_the_date();
            // $quem       = get_the_author();
            // $imagem      = '';
            // $teste       = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $conteudo, $encontrou);
            // $imagem      = (isset($encontrou[1][0])) ? $encontrou[1][0] : '';
            $dados[] = array(
                'postid'        => $identif,
                'titulo'        => $titulo,
                'tag'           => $tag,
                'cta_link'      => $cta_link,
                'cta_text'      => $cta_text,
                'guid_img_desk' => $guid_img_desk,
                'guid_img_mobi' => $guid_img_mobi,
                // 'postdate'   => $dia,
                // 'link'       => $link,
                // 'imagem'     => $imagem,
                // 'conteudo'   => $conteudo,
                // 'quem'       => $quem,
                // 'resumo'     => $resumo,
            );
        }
        wp_reset_query();

        $saida  = '';
        // $saida  = print_r($dados,true);
        // $saida .= '<div data-bs-spy="scroll" data-bs-target="#menu-list" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">';
        $saida .= '<section class="container-fluid header__lp position-relative" id="start">';
        $saida .= '<div class="card-img-overlay "><div class="mask-verde w-100"></div></div>';
        $saida .= '<div class="container h-100  position-relative">';
        $saida .= '<div class="row h-100 justify-content-start align-items-center">';
        $saida .= '<div class="col-12 col-lg-8 box-content">';
        $saida .= '<div class="row">';
        $saida .= '<div class="col-12 content-tag mb-4 d-flex justify-content-center justify-content-lg-start">';
        $saida .= '<p></p>';
        $saida .= '</div>';
        $saida .= '<div class="col-12 content-title"><h1></h1></div>';
        $saida .= '<div class="col-12 col-lg-auto btn-primary box-cta mt-5 mt-lg-4 d-flex justify-content-center justify-content-lg-start">';
        $saida .= '<a href="#" class="btn btn-header"></a>';
        $saida .= '</div>';
        $saida .= '</div>';
        $saida .= '</div>';
        $saida .= '</div>';
        $saida .= '<div class="row justify-content-center justify-content-lg-start">';
        $saida .= '<div class="controllers position-absolute">';
        $saida .= '<div class="d-flex justify-content-center justify-content-lg-start">';
        for ($ac = 0; $ac < count($dados); $ac++ ) {
            $saida .= '<div class="col-auto box-link  p-2" id="controller-'.$ac.'">';
            $saida .= '<a href="#" class="link-controller" onclick="startSlider(\'controller-'.$ac.'\', true)">';
            $saida .= '0'.($ac+1).'';
            $saida .= '<p>'.$dados[$ac]['titulo'].'</p>';
            $saida .= '</a>';
            $saida .= '<p class="d-none tag-name">'.$dados[$ac]['tag'].'</p>';
            $saida .= '<img src="'.$dados[$ac]['guid_img_desk'].'" class="d-none desk" alt="'.$dados[$ac]['titulo'].'">';
            $saida .= '<img src="'.$dados[$ac]['guid_img_mobi'].'" class="d-none mobile" alt="'.$dados[$ac]['titulo'].'">';
            $saida .= '<a href="'.$dados[$ac]['cta_link'].'" class="link-cta d-none">'.$dados[$ac]['cta_text'].'</a>';
            $saida .= '</div>';
        }
        $saida .= '</div>';
        $saida .= '</div>';
        $saida .= '</div>';
        $saida .= '</div>';
        $saida .= '<div class="col-12 position-relative box-arrow-white d-flex justify-content-center align-items-center">';
        $saida .= '<div class="position-absolute absolute-arrow d-flex flex-wrap">';
        $saida .= '<div class="col-12 mb-4 ">';
        $saida .= '<p class="d-lg-none">'.__('Saiba como manter a floresta em pé','pl-rede').'</p>';
        $saida .= '</div>';
        $saida .= '<div class="col-12 d-flex justify-content-center box-arrow-movie position-absolute">';
        $saida .= '<img src="' . get_template_directory_uri() .'/assets/images/graphics/arrows_white.svg" alt="">';
        $saida .= '</div>';
        $saida .= '</div>';
        $saida .= '</div>';
        $saida .= '</section>';
        return $saida;
    }
}
add_shortcode( 'carrosselhome', 'bloco_carrosselhome' );
