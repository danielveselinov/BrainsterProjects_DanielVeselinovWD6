<?php

/**
 * Checks whether REQUEST METHOD is POST or not
 * @return bool
 */
function onlyPostRequestMethod(): bool 
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        return true;
    }
    return false;
}


/**
 * Checks if user is logged or not
 */
function isLogged()
{
    return isset($_SESSION["auth"]) ?? null;
}

/**
 * Redirect to specfied file
 * @param string $route
 * @param int $id
 */
function route(string $route, int|string $id = null)
{
    global $routes;

    return str_replace("{ID}", $id, $routes[$route]) ?? "";
}

/**
 * Redirect to specified file (for errors, etc.)
 * @param string $route
 * @return void
 */
function redirect(string $route): void
{
    header("Location: {$route}");
    die();
}