<?php


namespace App\Core;


class Controller
{
    public string $layout = 'main';

    /**
     * Render view
     *
     * @param $view
     * @param array $params
     * @return string|string[]
     */
    public function render($view, array $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}