<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */

    use \App\Http\Response;
    use \App\Controller\Admin;

    // Rota do Home
    $obRouter->get('/admin',[
        'middlewares' => [
            'require-admin-login'
        ],
        function(){
            return new Response(200, 'Admin');
        }
    ]);

    // Rota de Login
    $obRouter->get('/admin/login',[
        'middlewares' => [
            'require-admin-logout'
        ],
        function($request){
            return new Response(200, Admin\Login::getLogin($request));
        }
    ]);


    // Rota de Login
    $obRouter->post('/admin/login',[
        'middlewares' => [
            'require-admin-logout'
        ],
        function($request){
            return new Response(200, Admin\Login::setLogin($request));
        }
    ]);

    // Rota de logout
    $obRouter->get('/admin/logout',[
        'middlewares' => [
            'require-admin-login'
        ],
        function($request){
            return new Response(200, Admin\Login::getLogout($request));
        }
    ]);