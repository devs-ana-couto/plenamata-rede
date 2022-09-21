<?php
function pb_ac_share($obj_id, $obj = null, $block, $echo = true){
    $generate_element = '';
    $hashtag = get_sub_field('gd-share-hashtag');
    $title = get_sub_field('gd-share-title');
    $rede_facebook = get_theme_mod('facebook');
    $rede_linkedin = get_theme_mod('linkedin');
    $rede_twitter = get_theme_mod('twitter');
    $canal_telegram = get_theme_mod('telegram');
    $canal_whatsapp = get_theme_mod('whatsapp');
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
                    <button type="button" class="btn d-none d-lg-flex compartilhe-cta active" id="compartilhe-cta">'.__('Acesse nossas redes','pl-rede').'</button>
                    <div class="col-auto midas-ativas">
                        <div class="col-6 d-flex justify-content-start social-medias px-3 medias-form gap-3" onmouseover="activeShare()" onmouseleave="defaultShared()" onclick="activeShare()">
                            {txt_facebook}{txt_linkedin}{txt_twitter}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-end box-canais">
                    <p>'.__('Faça parte dos nossos canais','pl-rede').'</p>{txt_telegram}{txt_whatsapp}
                </div>
            </div>
        </div>
    </section>
    ';

    $txt_facebook = ($rede_facebook!='') ? '<a href="'.$rede_facebook.'" id="facebook-share-btt" rel="nofollow" target="_blank" class="facebook-share-button"><img src="'.  get_template_directory_uri() . '/assets/images/icons-shared-white/facebook.svg" alt=""></a>' : '';
    $txt_linkedin = ($rede_linkedin!='') ? '<a href="'.$rede_linkedin.'" id="linkedin-share-btt" rel="nofollow" target="_blank" class="linkedin-share-button"><img src="'.  get_template_directory_uri() . '/assets/images/icons-shared-white/linkedin.svg" alt=""></a>' : '';
    $txt_twitter = ($rede_twitter!='') ? '<a href="'.$rede_twitter.'" id="twitter-share-btt" rel="nofollow" target="_blank" class="twitter-share-button"><img src="'.  get_template_directory_uri() . '/assets/images/icons-shared-white/twitter.svg" alt=""></a>' : '';
    $txt_telegram = ($canal_telegram!='') ? '<a href="'.$canal_telegram.'" target="_black"><img src="'.  get_template_directory_uri() . '/assets/images/graphics/telegram.svg" alt=""></a>' : '';
    $txt_whatsapp = ($canal_whatsapp!='') ? '<a href="'.$canal_whatsapp.'" target="_black"><img src="'.  get_template_directory_uri() . '/assets/images/graphics/whatsapp-footer.svg" alt=""></a>' : '';

    $generate_element =
        str_replace(
            array('{id}', '{hashtag}', '{title}', '{txt_facebook}', '{txt_linkedin}', '{txt_twitter}', '{txt_telegram}', '{txt_whatsapp}'),
            array($obj_id, $hashtag, $title, $txt_facebook, $txt_linkedin, $txt_twitter, $txt_telegram, $txt_whatsapp),
            $template);

    if ($echo) {
        echo $generate_element;
    }

    return $generate_element;

}