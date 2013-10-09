<?php

# System path
define('PROJECT_DOCUMENT_ROOT', __DIR__);

# Project name
$project = str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace("\\", "/", __DIR__));

# Connection protocol
(!isset($_SERVER['HTTPS']) OR $_SERVER['HTTPS'] == 'off') ? $protocol = 'http://' : $protocol = 'https://';

# Project path for online usage
define('PROJECT_HTTP_ROOT', $protocol.$_SERVER['HTTP_HOST'].$project);

# Classes root path
define('CLASS_ROOT', PROJECT_DOCUMENT_ROOT.'/src/php/classes');

# PHP root path
define('PHP_ROOT', PROJECT_DOCUMENT_ROOT.'/src/php');

# CSS root path
define('CSS_ROOT', PROJECT_DOCUMENT_ROOT.'/src/css');

# JS root path
define('JS_ROOT', PROJECT_DOCUMENT_ROOT.'/src/js');

# ExtSrc root path
define('EXTSRC_ROOT', PROJECT_DOCUMENT_ROOT.'/extSrc');

?>