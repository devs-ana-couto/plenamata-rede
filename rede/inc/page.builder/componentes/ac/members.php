<?php
function pb_ac_members($obj_id, $obj = null, $block, $echo = true)
{

    $generate_element = '';

    $title_container = get_sub_field("gd-el-title-container");

    $template = '
    <section class="container-fluid peoples" id="members">
            <div class="container">
                <div class="row">
                    <div class="col-12 title-down">
                        <h4>{title_container}</h4>
                    </div>
                </div>
            </div>
            <div class="col-12 p-0">
                <div class="row row-cols-2 row-cols-lg-6">
                    {content}
                </div>
            </div>
        </section>
    ';

    $content = '
    <div class="col p-0 box-image-hover position-relative">
        <img src="{photo}" alt="">
        <div class="card-img-overlay mask-image">
            <div class="col-12 h-100 d-flex no-hover justify-content-center align-items-end">
                <h5 class="">{name}</h5>
            </div>
            <div class="card position-relative">
                <div class="card-header">
                    <div class="col-12">
                        <h5>{name}</h5>
                    </div>
                    <div class="col-12">
                        <p>
                        {descript}
                        </p>
                    </div>
                </div>
                <div class="col-12 card-footer position-absolute d-flex justify-content-center">
                    <a href="{link_social}" class="btn btn-outline-light">'.__('Conheça mais','pl-rede').'</a>
                </div>
            </div>
        </div>
    </div>
    ';

    $generate_content = "";

    $members_array = get_sub_field('gd-el-title-members-repiter');

    foreach ($members_array as $key => $member):
        $name_member = $member['gd-el-title-members-repiter-name-member'];
        $photo_member = $member['gd-el-title-members-repiter-photo-member']['url'];
        $descript_member = $member['gd-el-title-members-repiter-description-members'];
        $link_members = $member['gd-el-title-members-repiter-midias-members'];

        $generate_content .= str_replace(
            array('{id}', '{name}', '{photo}', '{descript}', '{link_social}'),
            array($key, $name_member, $photo_member, $descript_member, $link_members),
            $content
        );
    endforeach;

    $generate_element =
        str_replace(
            array('{id}', '{title_container}', '{content}'),
            array($obj_id, $title_container, $generate_content),
            $template);

    if ($echo) {
        echo $generate_element;
    }

    return $generate_element;
}