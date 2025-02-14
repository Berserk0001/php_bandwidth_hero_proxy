<?php

namespace staifa\php_bandwidth_hero_proxy\test\test_runner;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('zend.assertions', 1);

include_once("fixtures/globals.php");
include_once("fixtures/config.php");
include_once("../auth.php");
include_once("../util.php");
include_once("../config.php");
include_once("../proxy.php");
include_once("../redirect.php");
include_once("../router.php");
require_once("../validation.php");
include_once("auth_test.php");
include_once("main_test.php");

use staifa\php_bandwidth_hero_proxy\test\auth_test;
use staifa\php_bandwidth_hero_proxy\test\main_test;

ob_start();
auth_test\failure();
main_test\success_webp();
ob_clean();
