<?php

define('DATABASE_NAME', 'ASMITH16_cs148_lab3');
define('DEBUG', true);

$_SERVER = filter_input_array(INPUT_SERVER, FILTER_SANITIZE_STRING);
define('SERVER', $_SERVER['SERVER_NAME']);

define ('DOMAIN', '//' . SERVER);

define ('PHP_SELF', $_SERVER['PHP_SELF']);
define ('PATH_PARTS', pathinfo(PHP_SELF));

define ('BASE_PATH', DOMAIN . PATH_PARTS['dirname'] . '/');

define ('LIB_PATH', 'lib/');

if(DEBUG) {
    print '<p>Domain: ' . DOMAIN;
    print '<p>PHP SELF: ' . PHP_SELF;
    print '<p>PATH Parts<pre>';
    print_r(PATH_PARTS);
    print '</pre></p>';
    print '<p>BASE_PATH: ' . BASE_PATH;
    print '<p>LIB_PATH: ' . LIB_PATH;
}

?>