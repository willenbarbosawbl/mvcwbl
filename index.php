<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */

    require_once __DIR__."/includes/app.php";

    use \App\Http\Router;
    
    //Inicia o Router
    $obRouter = new Router(getenv('URL'));

    //Inclui as rotas de páginas
    require_once __DIR__."/routes/pages.php";

    //Imprimi Response da Rota
    $obRouter->run()->sendResponse();

    /*echo '<pre>';
    print_r($obRouter);
    echo '</pre>'; exit;*/