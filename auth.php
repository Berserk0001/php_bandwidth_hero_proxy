<?php

namespace staifa\php_bandwidth_hero_proxy\auth;

use staifa\php_bandwidth_hero_proxy\router;

function start($config)
{
    $user = $config["auth_user"];
    $pwd = $config["auth_password"];
    if ($_SERVER["PHP_AUTH_USER"] == $user
      && $_SERVER["PHP_AUTH_PW"] == $pwd
      && array_reduce([$pwd, $user, $_SERVER["PHP_AUTH_USER"], $_SERVER["PHP_AUTH_PW"]], fn ($v) => isset($v))) {
        return router\route($config);
    };

    header("WWW-Authenticate: Basic realm=\"Bandwidth-Hero Compression Service\"");
    http_response_code(401);
    ob_clean();
    echo "Access denied";
};
