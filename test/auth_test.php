<?php

namespace staifa\php_bandwidth_hero_proxy\test\auth_test;

use staifa\php_bandwidth_hero_proxy\test\fixtures\config;
use staifa\php_bandwidth_hero_proxy\auth;

function failure()
{
    $overrides = function () { $_ENV["BHERO_LOGIN"] = null; };
    ob_start();
    auth\start(config\mock($overrides));
    $res = ob_get_contents();
    ob_end_clean();
    return assert($res == "Access denied");
}
