<?php

session_start();

define('DIR_TEMPLATE', 'template/');

define('DIR_CSS', 'assets/css/');
define('DIR_JS', 'assets/js/');
define('DIR_IMG', 'assets/img/');

define('DIR_CSS_ADMIN', 'assets/admin/css/');
define('DIR_JS_ADMIN', 'assets/admin/js/');
define('DIR_IMG_ADMIN', 'assets/admin/img/');

define('ADMIN', 'admin/');

define('DIR_VIEW_TEMPLATE', '');

define('PATH_FILES', FCPATH . '../files/');

define('FILES', 'files/');

define('MODULE_PATH', '/modules/');

class Return_type {
    const HTML = 0;
    const JSON = 1;
    const XML = 2;
}


class Response_status  {
    const ERROR = 0;
    const SUCCESS = 1;
    const SUCCESS_WITH_RELOAD = 2;
    const SUCCESS_WITH_REDIRECT = 3;
    const ERROR_WITH_REDIRECT = 4;
}

function definitions()
{
	// Dummy function so that the above definitions are loaded.
}

?>