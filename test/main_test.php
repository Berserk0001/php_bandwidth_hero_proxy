<?php

namespace staifa\php_bandwidth_hero_proxy\test\main_test;

use staifa\php_bandwidth_hero_proxy\test\fixtures\config;
use staifa\php_bandwidth_hero_proxy\auth;

function success_webp()
{
    $body = auth\start(config\mock(function () { return null; }));
    return assert(str_starts_with("RIFF:WEBPVP8X", $body));
}
