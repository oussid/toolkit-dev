<?php

function getPageName($url) {
    $url = $_SERVER['REQUEST_URI'];
    $urlParts = explode('/', $url);
    $adminIndex = array_search('admin', $urlParts);
    if ($adminIndex !== false && $adminIndex + 1 < count($urlParts)) {
        return $urlParts[$adminIndex + 1];
    }
    return 'dashboard';
}