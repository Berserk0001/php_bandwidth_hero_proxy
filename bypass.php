<?php

namespace staifa\php_bandwidth_hero_proxy\bypass;

function bypass($data, $response_headers)
{
    array_walk($response_headers, fn ($v, $k) => header($k . ": " . $v));
    header("x-proxy-bypass: 1");
    header("content-length: " . strlen($data));
    header_remove("Transfer-Encoding");

    ob_clean();
    echo $data;
    return false;
}
