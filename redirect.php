<?php

namespace staifa\php_bandwidth_hero_proxy\redirect;

function redirect($config)
{
    if (headers_sent()) {
        return false;
    }

    header("content-length: 0");
    $to_remove = ["cache-control", "expires","date", "etag"];
    array_walk($to_remove, fn ($v, $k) => header_remove($v));
    header("location: " . $config["target_url"]);
    http_response_code(302);

    return false;
};
