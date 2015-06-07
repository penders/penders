<?php
require SB_PAGINATE_INC_PATH . '/sb-plugin-install.php';

if(!sb_paginate_check_core()) {
    return;
}

require SB_PAGINATE_INC_PATH . '/sb-plugin-functions.php';

require SB_PAGINATE_INC_PATH . '/class-sb-paginate.php';

require SB_PAGINATE_INC_PATH . '/sb-plugin-admin.php';

require SB_PAGINATE_INC_PATH . '/sb-plugin-hook.php';