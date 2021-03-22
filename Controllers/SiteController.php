<?php


namespace App\Controllers;


use App\Core\Application;
use App\Core\Controller;
use App\Core\Request;

class SiteController extends Controller
{
    public function index()
    {

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        echo '<pre>';
        var_dump($request->getBody());
        echo '</pre>';
        exit;
        return;
    }

    public function home()
    {
//        $params = [
//            'name' => 'Domantas'
//        ];
        $name = 'Domantas';
        $surname = 'Slaiciunas';

        return $this->render('home', compact('name', 'surname'));
    }

    public function show()
    {
        return Application::$app->router->renderView('contact');
    }
}