<?php
function pb_ac_about_video($obj_id, $obj = null, $block, $echo = true){
    $generate_element = "";

    $iframe_video = get_sub_field('gd-el-about-iframe-video');
    $title_mask = get_sub_field('gd-el-about-title-description');
    $subtitle_maskless = get_sub_field('gd-el-about-subtitle-description');
    $descript = get_sub_field('gd-el-about-description');

    $template = '
    <section class="container-fluid video-intro" id="about">
            <div class="container h-100 d-flex align-items-center">
                <div class="row justify-content-end align-content-center  position-relative">
                    <div class="col-12 col-lg-6 h-100 d-flex align-items-center infos-video box-one">
                        {iframe_video}
                    </div>

                    <div class="col-12 col-lg-6 infos-video">
                        <div class="col-12 box-title">
                            <h3>{title_mask}</h3>
                        </div>
                        <div class="col-12 desc-01">
                            <h4>{subtitle_maskless}</h4>
                        </div>
                        <div class="col-12 desc-02">
                            <p>
                            {descript}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
    ';

    $generate_element = str_replace(
      array('{id}', '{iframe_video}', '{title_mask}', '{subtitle_maskless}', '{descript}'),
      array($obj_id, $iframe_video, $title_mask, $subtitle_maskless, $descript),
      $template
    );

    if($echo)
        echo $generate_element;

    return $generate_element;

}