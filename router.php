<?php

namespace staifa\php_bandwidth_hero_proxy\router;

use staifa\php_bandwidth_hero_proxy\proxy;

function route($config)
{
    $uri = $config["request_uri"];
    $route = ($pos = strpos($uri, "?")) ? substr($uri, 0, $pos) : $uri;
    if ($route == "/") {
        return proxy\send_request($config);
    }
    if ($route == "/favicon.ico") {
        http_response_code(204);
        ob_clean();
        echo null;
    };
};
