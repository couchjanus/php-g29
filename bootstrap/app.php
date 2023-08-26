<?php

define('ROOT', dirname(__DIR__));

require_once __DIR__.'/Autoloader.php';
// require_once __DIR__.'/helpers.php';

const VIEWS = ROOT.'/app/Views';
const CONTROLLERS = ROOT.'/app/Controllers';

const DB_CONFIG_FILE = ROOT.'/config/db.php';

const MEDIA = '/storage';

define('STORAGE', $_SERVER['DOCUMENT_ROOT'] . MEDIA);


(new Core\App())->run();