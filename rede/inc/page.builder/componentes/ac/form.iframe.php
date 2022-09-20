<?php
function pb_ac_form_frame($obj_id, $obj = null, $block, $echo = true){
    $generate_element = "";

    $form_desk = get_sub_field("gd-el-form-iframe-desktop");
    $form_mobile = get_sub_field("gd-el-form-iframe-mobile");
    $template = '
    <section class="container-fluid newsletter__lp" id="newsletter">
            <div class="container">
                <div class="row">
                    <div class="col-12 position-relative">
                        <div class="col-12 position-absolute box-form d-none d-lg-block">
                          {form_desk}
                        </div>
                        <div class="col-12 position-absolute box-form d-block d-lg-none">
                            {form_mobile}
                        </div>
                    </div>
                </div>
            </div>
    </section>
    ';

    $generate_element =
        str_replace(
            array('{id}', '{form_desk}', '{form_mobile}'),
            array($obj_id, $form_desk, $form_mobile),
            $template
        );

    if($echo)
        echo $generate_element;

    return $generate_element;
}