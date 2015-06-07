<?php
if(!function_exists('sb_paginate')) {
    function sb_paginate($args = array()) {
        SB_Paginate::show($args);
    }
}

function sb_paginate_testing() {
    return apply_filters('sb_paginate_testing', true);
}