<?php
/**
 *  CALENDARIO
 */

add_action( 'init', 'create_calendario' );
function create_calendario() {
	register_post_type( 'calendario',
	    array(
	      	'labels' => array(
		        'name' =>  'Calendário',
		        'singular_name' =>  'Calendário',
				'add_new' =>  'Adicionar Evento',
				'add_new_item' =>  'Adicionar Novo Evento',
				'edit_item' =>  'Editar Evento',
				'new_item' =>  'Novo Evento',
			),
			'public' => true,
			'capability_type' => 'post',
			'menu_icon' => 'dashicons-calendar-alt',
			'has_archive' => true,
			'rewrite' => array('slug' => 'calendario'),
			'supports' => array( 'title', 'editor', 'thumbnail'),
		)
	);
}


function calendario_add_campos() {
    add_meta_box( 'calendario_dados','Dados', 'calendario_campos_callback', 'calendario', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'calendario_add_campos' );


function calendario_campos_callback( $post ) {
    wp_nonce_field( 'calendario_campos_save_meta_box_data', 'calendario_campos_meta_box_nonce' );
    $mes       = get_post_meta( $post->ID, 'calendario_mes', true );
    $datade    = get_post_meta( $post->ID, 'calendario_datade', true );
    $dataaa    = get_post_meta( $post->ID, 'calendario_dataaa', true );
    $databreve = get_post_meta( $post->ID, 'calendario_databreve', true );
    $chapeu    = get_post_meta( $post->ID, 'calendario_chapeu', true );
    $cta_link  = get_post_meta( $post->ID, 'calendario_cta_link', true );
    $cta_text  = get_post_meta( $post->ID, 'calendario_cta_text', true );
    if (($datade=='') || ($dataaa!='')) {
        $datade = $dataaa;
        $dataaa = '';
    }
    if ($datade!='') {
        $databreve = '';
    }
    echo '<div>';
    echo '<strong>DATA:</strong><br/>';
    echo 'MÊS: <input type="number" min="1" max="12" name="calendario_mes" id="calendario_mes" value="'.$mes.'" />';
    echo '&nbsp;&nbsp;&nbsp;';
    echo 'DIA: <input type="number" min="1" max="31" name="calendario_datade" id="calendario_datade" value="'.$datade.'" /><br/>';
    // echo 'A: <input type="number" min="1" max="31" name="calendario_dataaa" id="calendario_dataaa" value="'.$dataaa.'" /><br/>';
    echo '<input type="checkbox" name="calendario_embreve" id="calendario_embreve" value="1"';
    if ($databreve=='1') {
        echo ' checked ';
    }
    echo '/> EM BREVE<br/>';
    echo '</div>';
    echo '<br><hr><br>';
    echo '<div>';
    echo '<strong>CHAPÉU:</strong>';
    echo '<input type="text" name="calendario_chapeu" id="calendario_chapeu" value="'.$chapeu.'" placeholder="CHAPÉU" style="width:100%" />';
    echo '</div>';
    echo '<br><hr><br>';
    echo '<div>';
    echo '<strong>CTA:</strong>';
    echo '<input type="text" name="calendario_cta_text" id="calendario_cta_text" value="'.$cta_text.'" placeholder="CTA TEXT" style="width:100%" />';
    echo '<br><br>';
    echo '<input type="text" name="calendario_cta_link" id="calendario_cta_link" value="'.$cta_link.'" placeholder="CTA LINK" style="width:100%" />';
    echo '</div>';
    echo '<br><hr><br>';
    echo '<div">';
}

function calendario_campos_save_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['calendario_campos_meta_box_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['calendario_campos_meta_box_nonce'], 'calendario_campos_save_meta_box_data' ) ) {
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
    $mes       = $_POST['calendario_mes'];
    $datade    = $_POST['calendario_datade'];
    $dataaa    = $_POST['calendario_dataaa'];
    $databreve = $_POST['calendario_databreve'];
    $chapeu    = $_POST['calendario_chapeu'];
    $cta_link  = $_POST['calendario_cta_link'];
    $cta_text  = $_POST['calendario_cta_text'];

    if (($datade=='') && ($dataaa!='')) {
        $datade = $dataaa;
        $dataaa = '';
    }
    if (($datade=='') && ($dataaa=='')) {
        $databreve = '1';
    }

    update_post_meta( $post_id, 'calendario_mes', $mes );
    update_post_meta( $post_id, 'calendario_datade', $datade );
    update_post_meta( $post_id, 'calendario_dataaa', $dataaa );
    update_post_meta( $post_id, 'calendario_databreve', $databreve );
    update_post_meta( $post_id, 'calendario_chapeu', $chapeu );
    update_post_meta( $post_id, 'calendario_cta_link', $cta_link );
    update_post_meta( $post_id, 'calendario_cta_text', $cta_text );
}
add_action( 'save_post', 'calendario_campos_save_meta_box_data' );


if (!function_exists('bloco_calendario')) {
    function bloco_calendario( $atts, $content = null ) {
        $conteudo_bloco = apply_filters( 'the_content', $content );
        $conteudo_bloco = str_replace( ']]>', ']]&gt;', $conteudo_bloco );
        $args = array (
            'post_type'       => 'calendario',
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
            $mes        = get_post_meta( $identif, 'calendario_mes', true );
            $datade     = get_post_meta( $identif, 'calendario_datade', true );
            $dataaa     = get_post_meta( $identif, 'calendario_dataaa', true );
            $databreve  = get_post_meta( $identif, 'calendario_databreve', true );
            $chapeu     = get_post_meta( $identif, 'calendario_chapeu', true );
            $cta_link   = get_post_meta( $identif, 'calendario_cta_link', true );
            $cta_text   = get_post_meta( $identif, 'calendario_cta_text', true );
            $conteudo   = apply_filters( 'the_content', get_the_content() );
            $conteudo   = str_replace( ']]>', ']]&gt;', $conteudo );
            $thumb_f    = '';
            $thumb_m    = '';
            $thumb_t    = '';
            if ( has_post_thumbnail()) {
                $thumb_id   = get_post_thumbnail_id();
                $thumb_url  = wp_get_attachment_image_src($thumb_id,'full', true);
                $thumb_f    = $thumb_url[0];
                $thumb_url  = wp_get_attachment_image_src($thumb_id,'medium', true);
                $thumb_m    = $thumb_url[0];
                $thumb_url  = wp_get_attachment_image_src($thumb_id,'thumbnail', true);
                $thumb_t    = $thumb_url[0];
            }
            // $resumo     = get_the_content();
            // $link       = get_permalink();
            // $dia        = get_the_date();
            // $quem       = get_the_author();
            // $imagem      = '';
            // $teste       = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $conteudo, $encontrou);
            // $imagem      = (isset($encontrou[1][0])) ? $encontrou[1][0] : '';
            $dados[$mes][$datade][] = array(
                'postid'   => $identif,
                'titulo'   => $titulo,
                'chapeu'   => $chapeu,
                'conteudo' => $conteudo,
                'cta_link' => $cta_link,
                'cta_text' => $cta_text,
                'mes'      => $mes,
                'datad'    => $datade,
                'dataa'    => $dataaa,
                'datab'    => $databreve,
                'imagef'   => $thumb_f,
                'imagem'   => $thumb_m,
                'imaget'   => $thumb_t,
            );

        }
        wp_reset_query();

        $meses = array('','Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
        $mes_atual  = date('n');

        $saida  = '';
        $saida .= '<section class="container-fluid calendar" id="calendar">';
        $saida .= '<div class="container">';
        $saida .= '<div class="row">';
        $saida .= '<div class="col-12 header">';
        $saida .= '<div class="row align-items-center">';
        $saida .= '<div class="col-12 col-lg-6 box-title">';
        $saida .= '<h6>'.$conteudo_bloco.'</h6>';
        $saida .= '</div>';
        $saida .= '</div>';
        $saida .= '<ul class="nav nav-tabs mt-5" id="myTab" role="tablist">';
        for ($me=1; $me<count($meses); $me++ ) {
            if ($me==$mes_atual) {
                $mostra = 'active';
            } else {
                $mostra = '';
            }
            $saida .= '<li class="nav-item" role="presentation">';
            $saida .= '<button class="nav-link '.$mostra.'" id="tab-'.$me.'" data-bs-toggle="tab" data-bs-target="#content-'.$me.'" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">'.__($meses[$me],'pl-rede').'</button>';
            $saida .= '</li>';
        }
        $saida .= '</ul>';
        $saida .= '<div class="tab-content" id="myTabContent">';
        for ($me=1; $me<count($meses); $me++ ) {
            if ($me==$mes_atual) {
                $mostra = 'show active';
            } else {
                $mostra = '';
            }
            $saida .= '<div class="tab-pane fade '.$mostra.'" id="content-'.$me.'" role="tabpanel"
    aria-labelledby="conteudo-'.$me.'" tabindex="0">';
            if (!(isset($dados[$me]))) {
                $saida .= '<h3 class="mt-5">'.$meses[$me].': '.__('sem atividade','pl-rede').'</h3>';
            } else {
                $saida .= '<div class="row">';
                $saida .= '<div class="col-12 box-calendar">';
                $saida .= '<div class="col-12 box-content-sliders mt-5" id="content-sliders">';
                $saida .= '<div class="row row-cols-1 row-cols-lg-2 justify-content-center">';
                $essemes = $dados[$me];
                foreach ($essemes as $dia => $eventos) {
                    for ($ev=0; $ev<count($eventos); $ev++) {
                        $evento = $eventos[$ev];
                        $saida .= '<div class="col item-slider" data-bs-target="'.$evento['datad'].'-'.$evento['mes'].'">';
                        $saida .= '<div class="card mb-3 rounded-0">';
                        $saida .= '<div class="row g-0 justify-content-center">';
                        $saida .= '<div class="col-12 col-lg-2 letf-date">';
                        $saida .= '<div class="card-body h-100 rounded-0 d-flex flex-wrap justify-content-between justify-content-lg-center align-content-between">';
                        $saida .= '<div class="col-auto col-lg-12 d-flex justify-content-center"><img src="' . get_template_directory_uri() .'/assets/images/graphics/icon_calendario.svg" alt="Calendário"></div>';
                        $saida .= '<div class="col-auto col-lg-12 d-flex justify-content-center align-items-center flex-wrap">';
                        if ($evento['datab']==1) {
                            $saida .= '<h6>'.__('EM BREVE','pl-rede').'</h6>';
                        } else {
                            $saida .= '<h6><strong>'.$evento['datad'].'</strong> '.strtoupper(substr(__($meses[$me],'pl-rede'),0,3)).'</h6>';
                        }
                        $saida .= '</div>'; //.col-auto
                        $saida .= '</div>'; //.card-body
                        $saida .= '</div>'; //.letf-date
                        $saida .= '<div class="col-md-10 box-image position-relative" style="background-image: url(\''.$evento['imagef'].'\'); background-size: cover; background-repeat: no-repeat">';
                        $saida .= '<div class="card-img-overlay mask-content-slider d-flex justify-content-start align-content-end align-items-end flex-wrap rounded-0">';
                        $saida .= '<h4 class="mb-2 w-100">'.$evento['chapeu'].'</h4>';
                        $saida .= '<h3 class="mb-2">'.$evento['titulo'].'</h3>';
                        $saida .= '<p class="">'.$evento['conteudo'].'</p>';
                        $saida .= '<a href="'.$evento['cta_link'].'" class="">'.$evento['cta_text'].'</a>';
                        $saida .= '</div>'; //.card-img-overlay
                        $saida .= '</div>'; //.box-image
                        $saida .= '</div>'; //.col-12
                        $saida .= '</div>'; //.card
                        $saida .= '</div>'; //.col
                    }
                }
                $saida .= '</div>'; //.row
                $saida .= '</div>'; //#content-sliders
                $saida .= '</div>'; //.box-calendar
                $saida .= '</div>'; //.row
            }
            $saida .= '</div>';
        }
        $saida .= '</div>';
        $saida .= '</div>';
        $saida .= '</div>';
        $saida .= '</div>';
        $saida .= '</section>';
        return $saida;
    }
}
add_shortcode( 'calendario', 'bloco_calendario' );
