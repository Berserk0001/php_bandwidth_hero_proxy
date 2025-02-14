<?php

namespace staifa\php_bandwidth_hero_proxy\config;

const DEFAULT_QUALITY = 40;
const MIN_COMPRESS_LENGTH = 128;

function create()
{
    $defaults = [
              "quality" => $_REQUEST["l"] ?? DEFAULT_QUALITY,
              "auth_user" => $_ENV["BHERO_LOGIN"],
              "auth_password" => $_ENV["BHERO_PASSWORD"],
              "greyscale" => $_REQUEST["bw"] ?? true,
              "min_compress_length" => MIN_COMPRESS_LENGTH,
              "target_url" => urldecode($_REQUEST["url"]),
              "request_uri" => urldecode($_SERVER["REQUEST_URI"]),
              "min_transparent_compress_length" => MIN_COMPRESS_LENGTH * 100,
              "webp" => !isset($_REQUEST["jpeg"])
    ];

    return $defaults;
};
