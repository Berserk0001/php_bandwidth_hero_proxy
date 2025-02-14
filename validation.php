<?php

namespace staifa\php_bandwidth_hero_proxy\validation;

include_once("bypass.php");
include_once("compression.php");

use staifa\php_bandwidth_hero_proxy\bypass;
use staifa\php_bandwidth_hero_proxy\compression;

use function staifa\php_bandwidth_hero_proxy\bypass\bypass;

function should_compress($config, $data, $request_headers, $response_headers)
{
    $checks = function () use ($config, $request_headers, $response_headers) {
        return !isset($config["request_uri"])
        || !isset($config["target_url"])
        || !str_starts_with($request_headers["origin_type"], "image")
        || (int)$request_headers["origin_size"] == 0
        || $config["webp"] && $request_headers["origin_size"] < $config["min_compress_length"]
        || (!$config["webp"]
             && (str_ends_with($request_headers["origin_type"], "png")
               || str_ends_with($request_headers["origin_type"], "gif"))
             && $request_headers["origin_size"] < $config["min_transparent_compress_length"]);
    };

    if ($checks()) {
        bypass($data, $response_headers);
        return false;
    };

    return compression\process_image($config, $data, $request_headers, $response_headers);
};
