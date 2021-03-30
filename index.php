<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */

    require_once __DIR__."/vendor/autoload.php";

    use \App\Http\Router;
    use App\Utils\View;

    define('URL', 'http://mvcwbl.srv.br');

    //Define o valor padrão das variáveis
    View::init([
        'URL' => URL
    ]);

    //Inicia o Router
    $obRouter = new Router(URL);

    //Inclui as rotas de páginas
    require_once __DIR__."/routes/pages.php";

    //Imprimi Response da Rota
    $obRouter->run()->sendResponse();

    /*echo '<pre>';
    print_r($obRouter);
    echo '</pre>'; exit;*/