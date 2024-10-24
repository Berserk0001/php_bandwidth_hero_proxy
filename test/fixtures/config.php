<?php

namespace staifa\php_bandwidth_hero_proxy\test\fixtures\config;

include_once("../boundary/http.php");
include_once("../boundary/logger.php");

include_once("../config.php");
include_once("fixtures/boundaries.php");

use staifa\php_bandwidth_hero_proxy\config;
use staifa\php_bandwidth_hero_proxy\test\fixtures\boundaries;

function mock()
{
    $_REQUEST["bw"] = 0;
    $_SERVER["headers"] = [];
    unset($_REQUEST["jpeg"]);
    unset($_REQUEST["l"]);

    return function () {
        $ctx = config\create();
        $ctx = $ctx();

        $ctx["config"]["min_compress_length"] = 1;
        $ctx["http"] = boundaries\http();
        $ctx["logger"] = boundaries\logger();

        return $ctx;
    };
};
