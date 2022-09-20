<?php
function pb_ac_share($obj_id, $obj = null, $block, $echo = true){
    $generate_element = '';
    $hashtag = get_sub_field('gd-share-hashtag');
    $title = get_sub_field('gd-share-title');
    $template = '
    <section class="container-fluid before-footer position-relative" id="shared">
        <div class="card-img-overlay mask-full"></div>
        <div class="card-img-overlay mask-50"></div>
        <div class="container h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 box-title">
                    <h4>{title}</h4>
                </div>
                <div class="col-12 box-hash-tag">
                    <h2>{hashtag}</h2>
                </div>
                <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-start social-medias px-3" id="medias-form-footer" onmouseover="activeShare(\'#medias-form-footer\')" onmouseleave="defaultShared(\'#medias-form-footer\')" onclick="activeShare(\'#medias-form-footer\')">
                    <button type="button" class="btn d-none d-lg-flex compartilhe-cta active" id="compartilhe-cta">'.__('Compartilhe nas redes','pl-rede').'</button>
                    <div class="col-auto midas-ativas">
                        <div class="col-6 d-flex justify-content-start social-medias px-3 medias-form gap-3" onmouseover="activeShare()" onmouseleave="defaultShared()" onclick="activeShare()">
                            <a href="" id="facebook-share-btt" rel="nofollow" target="_blank" class="facebook-share-button"><img src="'.  get_template_directory_uri() . '/assets/images/icons-shared-white/facebook.svg" alt=""></a>
                            <a href="" id="linkedin-share-btt" rel="nofollow" target="_blank" class="linkedin-share-button"><img src="'.  get_template_directory_uri() . '/assets/images/icons-shared-white/linkedin.svg" alt=""></a>
                            <a href="" id="twitter-share-btt" rel="nofollow" target="_blank" class="twitter-share-button"><img src="'.  get_template_directory_uri() . '/assets/images/icons-shared-white/twitter.svg" alt=""></a>
                            <a href="whatsapp://send?text=Conheça a Rede Amazônia Viva - ' .get_permalink()  .'"><img src="'.  get_template_directory_uri() . '/assets/images/icons-shared-white/whatsapp.svg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-end box-canais">
                    <p>'.__('Faça parte dos nossos canais','pl-rede').'</p>
                    <a href="https://t.me/share/url?url=' .get_permalink()  .'&text=Conheça a Rede Amazônia Viva" target="_black"><img src="'.  get_template_directory_uri() . '/assets/images/graphics/telegram.svg" alt=""></a>
                    <a href="https://bit.ly/3S0brX1"><img src="'.  get_template_directory_uri() . '/assets/images/graphics/whatsapp-footer.svg" alt=""></a>
                </div>
            </div>
        </div>
    </section>
    ';

    $generate_element =
        str_replace(
            array('{id}', '{hashtag}', '{title}'),
            array($obj_id, $hashtag, $title),
            $template);

    if ($echo) {
        echo $generate_element;
    }

    return $generate_element;

}