<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */

    use \App\Http\Response;
    use \App\Controller\Pages;

    // Rota do Home
    $obRouter->get('/',[
        function(){
            return new Response(200, Pages\Home::getHome());
        }
    ]);

    // Rota Sobre
    $obRouter->get('/sobre',[
        function(){
            return new Response(200, Pages\Sobre::getSobre());
        }
    ]);

    // Rota de Depoimentos
    $obRouter->get('/depoimentos',[
        function($request){
            return new Response(200, Pages\Depoimentos::getDepoimentos($request));
        }
    ]);

    // Rota de Depoimentos
    $obRouter->post('/depoimentos',[
        function($request){
            return new Response(200, Pages\Depoimentos::insertTestimony($request));
        }
    ]);

    // Rota Dinâminca
    $obRouter->get('/pagina/{idPagina}',[
        function($idPagina){
            return new Response(200, $idPagina);
        }
    ]);