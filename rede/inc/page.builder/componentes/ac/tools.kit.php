<?php
function pb_ac_toolskit($obj_id, $obj = null, $block, $echo = true)
{
    $generate_element = '';

    $title_container = get_sub_field('gd-tools-kit-title-container');
    $decript_container = get_sub_field('gd-tools-kit-description-container');

    $tools_row = get_sub_field('gd-tools-kit-tools-repiters');
    $template = '<section class="container-fluid tools" id="tools">
            <div class="container">
                <div class="row">
                    <div class="col-12 box-title-tools">
                        <h3>{title_container}</h3>
                        <p>{desc_container}</p>
                    </div>
                    <!-- <div class="col-12 box-filter">
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item m-1 m-lg-2 active" id="todos">
                                <button class="btn" onclick="filtroNews(\'todos\')">'.__('Todos','pl-rede').'</button>
                            </li>
                        </ul>
                    </div> -->
                </div>

                <div class="col-12 box-cards mt-5">
                    <div class="row row-cols-1 row-cols-lg-3 g-4">
                        {content}
                    </div>
                </div>
            </div>
        </section>';

    $content = '
    <div class="col col-cards">
        <div class="card h-100 p-4 position-relative" data-bs-target="assunto-{id}">
            <!--<div class="tag-card green">
                    <p>Assunto 1</p>
                 </div>-->
                 <div class="col-12 d-flex justify-content-center">
                     <img src="{icon}"
                         class="card-img-top" alt="...">
                 </div>
            <div class="card-body p-0">
                <h5 class="card-title mt-4">{title}</h5>
                <p class="card-text mt-4">{descript}</p>
            </div>
            <div class="card-footer p-0 mt-4">
                <a href="{link_cta}" class="btn btn-secondary" target="_blank">{text_cta}</a>
            </div>
        </div>
    </div>
    ';

    $generate_content = '';

    foreach ($tools_row as $key => $tool):
        $icon = $tool['gd-tools-kit-tools-icon']['url'];
        $title = $tool['gd-tools-kit-tools-name'];
        $descript = $tool['gd-tools-kit-tools-description'];
        $text_cta = $tool['cta']['gd-tools-kit-cta-text'];
        $link_cta = $tool['cta']['gd-tools-kit-tools-link-cta'];
        $generate_content .= str_replace(
            array('{key}', '{icon}', '{title}', '{descript}', '{text_cta}', '{link_cta}'),
            array($key, $icon, $title, $descript, $text_cta, $link_cta),
            $content
        );
    endforeach;

    $generate_element =
        str_replace(
            array('{id}', '{content}', '{title_container}', '{desc_container}'),
            array($obj_id, $generate_content, $title_container, $decript_container),
            $template);


    if ($echo) {
        echo $generate_element;
    }

    return $generate_element;

}