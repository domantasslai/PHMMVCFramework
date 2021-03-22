<?php

namespace App\Core;

class Router
{
    protected array $routes = [];
    public Request $request;
    public Response $response;

    /**
     * Router constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Store to Array GET request path with given callback
     * @param $path
     * @param $callback
     */
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * Resolve incoming request
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView('errors/_404');
        }
        // Render view if class and method not passed
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        // If passed class and method
        if (is_array($callback)) {
            Application::$app->controller = new $callback[0];
            $callback[0] = Application::$app->controller;
        }

        // Execute callback if it exists
        return call_user_func($callback, $this->request);
    }

    /**
     * Render view from request
     * @param $view
     * @param array $params
     * @return string|string[]
     */
    public function renderView($view, array $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * Render view from request
     * @param $viewContent
     * @return array|bool|string
     */
    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * Cache content layout
     * @return false|string
     */
    protected function layoutContent()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR . "/Views/layouts/{$layout}.php";
        return ob_get_clean();
    }

    /**
     * Cache view
     * @param $view
     * @param array $params
     * @return false|string
     */
    protected function renderOnlyView($view, array $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/Views/$view.php";
        return ob_get_clean();
    }

}