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
    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * If incoming request GET return boolean value
     * @return bool
     */
    public function isGet(): bool
    {
        return $this->method() === 'get';
    }

    /**
     * If incoming request POST return boolean value
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->method() === 'post';
    }

    /**
     * Sanitize request value for malicious data
     * @return array
     */
    public function getBody(): array
    {
        $body = [];
        if ($this->method() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->method() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }
}