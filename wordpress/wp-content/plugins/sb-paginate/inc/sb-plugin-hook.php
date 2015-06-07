<?php
if(!function_exists('sb_paginate_style_and_script')) {
    function sb_paginate_style_and_script() {
        if(sb_paginate_testing()) {
            wp_enqueue_style('sb-paginate-style', SB_PAGINATE_URL . '/css/sb-paginate-style.css');
            wp_enqueue_script('sb-paginate', SB_PAGINATE_URL . '/js/sb-paginate-script.js', array('jquery'), false, true);
        } else {
            wp_enqueue_style('sb-paginate-style', SB_PAGINATE_URL . '/css/sb-paginate-style.min.css');
            wp_enqueue_script('sb-paginate', SB_PAGINATE_URL . '/js/sb-paginate-script.js', array('jquery'), false, true);
        }
    }
}
add_action('wp_enqueue_scripts', 'sb_paginate_style_and_script');