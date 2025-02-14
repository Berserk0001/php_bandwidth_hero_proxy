<?php

namespace staifa\php_bandwidth_hero_proxy\test\fixtures\config;

use staifa\php_bandwidth_hero_proxy\fixtures\globals;

use function staifa\php_bandwidth_hero_proxy\config\create;

function mock($overrides)
{
    globals\set_defaults();
    $overrides();
    $config = create();
    return $config;
};
