<?php


function get_uri()
{
    return $_SERVER['REQUEST_URI'];
}

function home()
{
    return '<h1>Home Page</h1>';
}

function about()
{
    return '<h1>About Page</h1>';
}
function not_found()
{
    return '<h1>404 - not found</h1>';
}

$route = match(get_uri()) {
    '/' => home(),
    '/about' => about(),
    default => not_found(),
};
    

echo $route;
