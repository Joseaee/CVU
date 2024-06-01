<?php 

require "vendor/autoload.php";

use Cvu\Content\Config\Settings\SystemConfig as SystemConfig;
use Cvu\Content\Controllers\FrontController as FrontController;

$globalConfig = new SystemConfig();
$globalConfig->existController();

$frontController = new FrontController();
