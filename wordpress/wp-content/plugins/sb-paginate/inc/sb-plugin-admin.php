<?php
function sb_paginate_menu() {
    SB_Admin_Custom::add_submenu_page('SB Paginate', 'sb_paginate', array('SB_Admin_Custom', 'setting_page_callback'));
}
add_action('sb_admin_menu', 'sb_paginate_menu');

function sb_paginate_tab($tabs) {
    $tabs['sb_paginate'] = array('title' => 'SB Paginate', 'section_id' => 'sb_paginate_section', 'type' => 'plugin');
    return $tabs;
}
add_filter('sb_admin_tabs', 'sb_paginate_tab');

function sb_paginate_setting_field() {
    SB_Admin_Custom::add_section('sb_paginate_section', __('SB Paginate options page', 'sb-paginate'), 'sb_paginate');
	SB_Admin_Custom::add_setting_field('sb_paginate_label', __('Label', 'sb-paginate'), 'sb_paginate_section', 'sb_paginate_label_callback', 'sb_paginate');
	SB_Admin_Custom::add_setting_field('sb_paginate_next_text', __('Next text', 'sb-paginate'), 'sb_paginate_section', 'sb_paginate_next_text_callback', 'sb_paginate');
	SB_Admin_Custom::add_setting_field('sb_paginate_previous_text', __('Previous text', 'sb-paginate'), 'sb_paginate_section', 'sb_paginate_previous_text_callback', 'sb_paginate');
    SB_Admin_Custom::add_setting_field('sb_paginate_range', 'Range', 'sb_paginate_section', 'sb_paginate_range_callback', 'sb_paginate');
    SB_Admin_Custom::add_setting_field('sb_paginate_anchor', 'Anchor', 'sb_paginate_section', 'sb_paginate_anchor_callback', 'sb_paginate');
    SB_Admin_Custom::add_setting_field('sb_paginate_gap', 'Gap', 'sb_paginate_section', 'sb_paginate_gap_callback', 'sb_paginate');
    SB_Admin_Custom::add_setting_field('sb_paginate_style', __('Style', 'sb-paginate'), 'sb_paginate_section', 'sb_paginate_style_callback', 'sb_paginate');
    SB_Admin_Custom::add_setting_field('sb_paginate_border_radius', __('Border radius', 'sb-paginate'), 'sb_paginate_section', 'sb_paginate_border_radius_callback', 'sb_paginate');
}
add_action('sb_admin_init', 'sb_paginate_setting_field');

function sb_paginate_next_text_callback() {
	$options = SB_Option::get();
	$value = isset($options['paginate']['next_text']) ? $options['paginate']['next_text'] : '&raquo;';
	$id = 'sb_paginate_next_text';
	$name = 'sb_options[paginate][next_text]';
	$description = __('The text for previous page button.', 'sb-comment');
    $args = array(
        'id' => $id,
        'name' => $name,
        'value' => $value,
        'desciption' => $description
    );
	SB_Field::text_field($args);
}

function sb_paginate_previous_text_callback() {
	$options = SB_Option::get();
	$value = isset($options['paginate']['previous_text']) ? $options['paginate']['previous_text'] : '&laquo;';
	$id = 'sb_paginate_previous_text';
	$name = 'sb_options[paginate][previous_text]';
	$description = __('The text for next page button.', 'sb-comment');
    $args = array(
        'id' => $id,
        'name' => $name,
        'value' => $value,
        'description' => $description
    );
	SB_Field::text_field($args);
}

function sb_paginate_label_callback() {
	$options = SB_Option::get();
	$value = isset($options['paginate']['label']) ? $options['paginate']['label'] : __('Trang', 'sb-paginate');
	$id = 'sb_paginate_label';
	$name = 'sb_options[paginate][label]';
	$description = __('The label text to display before pagination.', 'sb-comment');
    $args = array(
        'id' => $id,
        'name' => $name,
        'value' => $value,
        'description' => $description
    );
	SB_Field::text_field($args);
}

function sb_paginate_range_callback() {
    $options = SB_Option::get();
    $value = isset($options['paginate']['range']) ? $options['paginate']['range'] : 3;
    $description = __('The number of page links to show before and after the current page.', 'sb-paginate');
    printf('<input type="number" id="%1$s" name="%2$s" value="%3$s" class="" min="1" max="100"><p class="description">%4$s</p>', 'sb_paginate_range', esc_attr('sb_options[paginate][range]'), $value, $description);
}

function sb_paginate_anchor_callback() {
    $options = SB_Option::get();
    $value = isset($options['paginate']['anchor']) ? $options['paginate']['anchor'] : 1;
    $description = __('The number of page links to show at beginning and end of pagination.', 'sb-paginate');
    printf('<input type="number" id="%1$s" name="%2$s" value="%3$s" class="" min="1" max="10"><p class="description">%4$s</p>', 'sb_paginate_anchor', esc_attr('sb_options[paginate][anchor]'), $value, $description);
}

function sb_paginate_gap_callback() {
    $options = SB_Option::get();
    $value = isset($options['paginate']['gap']) ? $options['paginate']['gap'] : 3;
    $description = __('The minimum number of page links before ellipsis shows.', 'sb-paginate');
    printf('<input type="number" id="%1$s" name="%2$s" value="%3$s" class="" min="1" max="100"><p class="description">%4$s</p>', 'sb_paginate_gap', esc_attr("sb_options[paginate][gap]"), $value, $description);
}

function sb_paginate_style_callback() {
    $args = array(
        'default' => __('Default', 'sb-paginate'),
        'orange' => __('Orange', 'sb-paginate'),
        'dark' => __('Dark', 'sb-paginate')
    );
    $styles = apply_filters('sb_paginate_style', $args);
    $name = 'sb_paginate_style';
    $options = SB_Option::get();
    $value = isset($options['paginate']['style']) ? $options['paginate']['style'] : 'default';
    $description = __('Choose style color for pagination.', 'sb-paginate');
    ?>
    <label for="<?php echo $name; ?>"></label>
    <select id="<?php echo $name; ?>" name="<?php echo esc_attr('sb_options[paginate][style]'); ?>">
        <?php foreach($styles as $key => $title) : ?>
            <option value="<?php echo $key; ?>"<?php selected( $value, $key ); ?>><?php echo $title; ?></option>
        <?php endforeach; ?>
    </select>
    <p class="description"><?php echo $description; ?></p>
<?php
}

function sb_paginate_border_radius_callback() {
    $args = array(
        'default' => __('Default', 'sb-paginate'),
        'elipse' => __('Elipse', 'sb-paginate'),
        'none' => __('None', 'sb-paginate')
    );
    $styles = apply_filters('sb_paginate_border_radius', $args);
    $name = 'sb_paginate_border_radius';
    $options = SB_Option::get();
    $value = isset($options['paginate']['border_radius']) ? $options['paginate']['border_radius'] : 'default';
    $description = __('You can make navigation buttons have border radius or not.', 'sb-paginate');
    ?>
    <label for="<?php echo $name; ?>"></label>
    <select id="<?php echo $name; ?>" name="<?php echo esc_attr('sb_options[paginate][border_radius]'); ?>">
        <?php foreach($styles as $key => $title) : ?>
            <option value="<?php echo $key; ?>"<?php selected( $value, $key ); ?>><?php echo $title; ?></option>
        <?php endforeach; ?>
    </select>
    <p class="description"><?php echo $description; ?></p>
<?php
}

function sb_paginate_sanitize($input) {
    $data = $input;
    $data['paginate']['range'] = isset($input['paginate']['range']) ? $input['paginate']['range'] : 3;
    $data['paginate']['gap'] = isset($input['paginate']['gap']) ? $input['paginate']['gap'] : 3;
    $data['paginate']['anchor'] = isset($input['paginate']['anchor']) ? $input['paginate']['anchor'] : 1;
    $data['paginate']['style'] = isset($input['paginate']['style']) ? $input['paginate']['style'] : 'default';
    $data['paginate']['border_radius'] = isset($input['paginate']['border_radius']) ? $input['paginate']['border_radius'] : 'default';
    return $data;
}
add_filter('sb_options_sanitize', 'sb_paginate_sanitize');