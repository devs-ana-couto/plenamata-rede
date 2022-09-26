<?php
function pb_ac_master_class($obj_id, $obj = null, $block, $echo = true)
{
    $generate_element = '';

    $tag_container = get_sub_field('gd-master-class-tag-container');
    $title_container = get_sub_field('gd-master-class-text-title');
    $desc_container = get_sub_field('gd-master-class-desc-container');

    $aulas_row = get_sub_field('gd-master-class-desc-repiter');
    // if(!empty($aulas_row)){
    // sort($aulas_row, SORT_DESC | SORT_NATURAL);
    // }
    $template = '
    <section class="container-fluid master-class" id="master-class">
            <div class="container">
                <div class="row">
                    <div class="col-12 box-master-infos">
                        <div class="row">
                            <div class="col-12 col-lg-5 d-flex mb-5 mb-lg-auto flex-wrap align-items-center">
                                <div class="col-12">
                                    <span class="mb-4">{tag_container}</span>
                                    <h4 class="mb-4">{title_container}</h4>
                                    <p class="mb-4">
                                        {desc_container}
                                    </p>
                                </div>
                            </div>
                            {last_content}
                        </div>
                    </div>
<!-- Descomentar quando for inserir os slider a baixo -->
                    <div class="row">
                        <div class="col-12  box-master-slider">
                            <h3>'.__('Assista outros episódios','pl-rede').'</h3>
                        </div>
                        <div class="col-12 slider mb-5">
                            <div class="owl-carousel owl-theme" id="carousel-master-class">
                            {container_list}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

';
    $generate_content_list = '';
    if (empty($aulas_row)) {
        $last_content = '
        <div class="col-12 col-lg-7 mb-5 mb-lg-auto box-images-video position-relative"
                                 style="background-image: url(\' ' . get_template_directory_uri() . '/assets/images/thumb_master.jpg\') !important; background-size: cover !important;">
                                    <div class="card-img-overlay mask-img d-flex flex-wrap justify-content-center align-content-center">
                                <img src="' . get_template_directory_uri() . '/assets/images/video-box/icon_play.svg"
                                alt="">
                                <div class="col-12 d-flex justify-content-center text-white">
                                    '.__('EM BREVE','pl-rede').'
                                </div>
                            </div>';

        $content_list = '
            <div class="item">
                <div class="card position-relative">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-lg-6 box-imagem d-flex flex-wrap position-relative justify-content-center align-items-center"
                             style="background-image: url(\'' . get_template_directory_uri() . '/assets/images/thumb_master.jpg\'); background-size: cover; background-repeat: no-repeat; background-position: center center;">
                            <img src="' . get_template_directory_uri() . '/assets/images/video-box/icon_play.svg"
                                 alt="">
                            <div class="col-12 d-flex justify-content-center mb-2 text-white"
                                 style="z-index: 1030;">
                                '.__('EM BREVE','pl-rede').'
                            </div>
                            <div class="card-img-overlay mask-slider-master-class"></div>
                        </div>
                        <div class="col-12 col-lg-6 p-0 p-lg-3">
                            <h5>'.__('Em breve','pl-rede').'</h5>
                        </div>
                    </div>
                </div>
            </div>
    ';
        $generate_last_content = str_replace(
            array(),
            array(),
            $last_content
        );
        for ($i = 0; $i <= 4; $i++) {
            $generate_content_list .= str_replace(
                array(),
                array(),
                $content_list
            );
        }
    } else {
        $last_content = '
        <div class="col-12 col-lg-7 mb-5 mb-lg-auto box-images-video position-relative">
             <iframe style="width: 100%; height: 100%;"  src="{link_video}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>';
        $content_list = '
            <div class="item">
                <div class="card position-relative">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-lg-6 box-imagem d-flex flex-wrap position-relative justify-content-center align-items-center">
                            <iframe style="width: 100%; height: 100%;"  src="{link_video}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="col-12 col-lg-6 p-0 p-lg-3">
                            <h5>{title_video}</h5>
                        </div>
                    </div>
                </div>
            </div>
    ';

        foreach ($aulas_row as $key => $aula):
            $link_video = $aula['gd-master-class-desc-repiter-link-video'];
            $title_video = $aula['gd-master-class-desc-repiter-title-video'];
            if ($key === 0) {
                $generate_last_content = str_replace(
                    array('{link_video}', '{title_video}'),
                    array($link_video, $title_video),
                    $last_content
                );
            } else {

                $generate_content_list .= str_replace(
                    array('{link_video}', '{title_video}'),
                    array($link_video, $title_video),
                    $content_list
                );
            }
        endforeach;
    }

    $generate_element =
        str_replace(
            array('{id}', '{last_content}', '{container_list}', '{tag_container}', '{title_container}', '{desc_container}'),
            array($obj_id, $generate_last_content, $generate_content_list, $tag_container, $title_container, $desc_container),
            $template);

    if ($echo) {
        echo $generate_element;
    }

    return $generate_element;


}