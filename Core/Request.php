<?php


namespace App\Core;


class Request
{
    /**
     * Get Incoming request path
     * return request without URL parameters
     * @return false|mixed|string
     */
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        // If not have URL parameters, return path
        if ($position === false) {
            return $path;
        }
        // Take path from beginning until finds URL parameters
        return substr($path, 0, $position);
    }

    /**
     * Get Incoming request Method (GET, POST)
     * @return string
     */
    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}