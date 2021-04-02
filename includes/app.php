<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */

    require_once __DIR__."/../vendor/autoload.php";

    
    use App\Utils\View;
    use \WilliamCosta\DotEnv\Environment;
    use \WilliamCosta\DatabaseManager\Database;
    use \App\Http\Middleware\Queue;

    //Carrega variáveis de ambiente
    Environment::load(__DIR__."/../");    

    //Configura Banco de Dados
    Database::config(
        getenv('DB_HOST'),
        getenv('DB_NAME'),
        getenv('DB_USER'),
        getenv('DB_PASS'),
        getenv('DB_PORT')
    );

    //Define o valor padrão das variáveis
    View::init([
        'URL' => getenv('URL')
    ]);

    //DEFINE O MAPEAMENTO DE MIDDLEWARES
    Queue::setMap([
        'maintenance' => \App\Http\Middleware\Maintenance::class
    ]);

    //DEFINE O MAPEAMENTO DE MIDDLEWARES PADRÕES EXECUTADOS EM TODAS AS ROTAS
    Queue::setDefault([
        'maintenance'
    ]);