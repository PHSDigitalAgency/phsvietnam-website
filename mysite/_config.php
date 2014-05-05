<?php

global $project;
$project = 'mysite';

global $database;
$database = '';

require_once('conf/ConfigureFromEnv.php');

// Set the site locale
i18n::set_locale('en_US');
Translatable::set_default_locale('en_US');
Translatable::set_allowed_locales(array('en_US', 'fr_FR', 'vi_VN'));

OpenGraphObjectExtension::$default_image = 'mysite/images/PHS-logo.png';