<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */

    namespace App\Http\Middleware;

    use \Exception;

    class Queue{
       
        /**
         * Mapeamento de middlewares que serão carregados em todas as rotas
         * @var array
         */
        private static $default = [];

        /**
         * Mapeamento de middlewares
         * @var array
         */
        private static $map = [];

        /**
         * Fila de Middlewares a serem executados
         * @var array
         */
        private $middlewares = [];

        
        /**
         * Função de execução do controlador
         * @var Closure
         */
        private $controller;
        
        /**
         * Argumentos da função do controlador
         * @var array
         */
        private $controller_args = [];

        /**
         * Método responsável por construir a classe de fila de middlewares
         * @param array $middlewares
         * @param Closure $controller
         * @param array $controller_args
         */
        public function __construct($middlewares, $controller, $controller_args){
            $this->middlewares      = array_merge(self::$default, $middlewares);
            $this->controller       = $controller;
            $this->controller_args  = $controller_args;
        }

        /**
         * Método responsável por executar o próximo nível da fila de middlewares
         * @param Request $request
         * @return Response
         */
        public function next($request){
            //VERIFICA SE A FILA ESTÁ VÁZIA
            if (empty($this->middlewares)) return call_user_func_array($this->controller, $this->controller_args);

            //MIDDLEWARE
            $middleware = array_shift($this->middlewares);

            //VERIFICA O MAPEAMENTO
            if (!isset(self::$map[$middleware])){
                throw new Exception("Problemas ao processar o middleware da requisição!", 500);
            }

            //NEXT
            $queue = $this;
            $next = function($request)use($queue){
                return $queue->next($request);
            };

            //EXECUTA O MIDDLEWARE
            return (new self::$map[$middleware])->handle($request,$next);

            /*echo '<pre>';
            print_r(self::$map[$middleware]);
            echo '</pre>';exit;*/
        }

        /**
         * Método responsável por definir o mapeamento de middlewares
         * @param array $map
         */
        public static function setMap($map){
            self::$map = $map;
        }

        /**
         * Método responsável por definir o mapeamento de middlewares padrão
         * @param array $default$map
         */
        public static function setDefault($default){
            self::$default = $default;
        }
    }