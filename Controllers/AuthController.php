<?php


namespace App\Controllers;


use App\Core\Controller;
use App\Core\Request;
use App\Models\Register;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return string|string[]
     */
    public function login(Request $request)
    {
        $this->setLayout('auth');
        return $this->render('login');
    }

    /**
     * @param Request $request
     * @return string|string[]
     */
    public function register(Request $request)
    {
        $register = New Register();
        if ($request->isPost()){
            $register->loadData($request->getBody());
            if ($register->validate() && $register->register()) {
                return 'Success';
            }

            return $this->render('register', [
                'model' => $register
            ]);
        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $register
        ]);
    }
}