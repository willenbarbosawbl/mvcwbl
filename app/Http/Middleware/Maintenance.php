<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */

    namespace App\Http\Middleware;

    use Exception;

    class Maintenance{
        
        /**
         * Método responsável por executar o middleware
         * @param Request $request
         * @param Closure $next
         * @return Response
         */
        public function handle($request, $next){
            //VERIFICA O ESTADO DE MANUTENÇÃO DA PÁGINA
            if (getenv('MAINTENANCE') == 'true'){
                throw new Exception("Página em manutenção. Tente novamente mais tarde.", 200);
            }
            //EXECUTA O PRÓXIMO NÍVEL DO MIDDLEWARE
            return $next($request);
            /*echo '<pre>';
            print_r($request);
            echo '</pre>';exit;*/
        }
        
    }