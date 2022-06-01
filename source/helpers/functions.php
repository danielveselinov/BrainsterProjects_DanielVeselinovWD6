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

/**
 * Check if any empty fields
 */
function emptyFields($data)
{
    $flag = false;

    foreach ($data as $value) {
        if (isset($value)) {
            if (empty($value)) {
                $flag = true;
            } 
        }
    }

    if ($flag) {
        echo json_encode(['auth' => false, 'message' => 'All fields are required']);
        exit;
    }
}