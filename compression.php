<?php

namespace staifa\php_bandwidth_hero_proxy\compression;

const WEBP_MAX_HEIGHT = 16383;

function process_image($config, $data, $request_headers, $response_headers)
{
    $format = $config["webp"] ? "webp" : "jpeg";
    $inst = imagecreatefromstring($data);
    $quality = $config["quality"];
    $height = imagesy($inst);

    if ($request_headers["origin_type"] == "image/png" || "image/gif") {
        imagepalettetotruecolor($inst);
    };
    if ($config["greyscale"]) {
        imagefilter($inst, IMG_FILTER_GRAYSCALE);
    };
    if ($format == "webp" && $height > WEBP_MAX_HEIGHT) {
        $width = imagesx($inst);
        $new_height = WEBP_MAX_HEIGHT;
        $new_width = ($width / $height) * $new_height;
        $inst = imagescale($inst, $new_width, $new_height);
    };

    ob_start();

    ($format == "webp") ? imagewebp($inst, null, $quality) : imagejpeg($inst, null, $quality);
    $converted_image = ob_get_contents();
    $headers = array_merge($response_headers, ["content-encoding" => "identity"]);
    ob_end_clean();
    imagedestroy($inst);

    array_walk($headers, fn ($v, $k) => header($k . ": " . $v));

    $size = strlen($converted_image);
    header("content-length: " . $size);
    header("content-type: image/" . $format);
    header("x-original-size: " . $request_headers["origin_size"]);
    header("x-bytes-saved: " . $request_headers["origin_size"] - $size);

    echo $converted_image;
};
