<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */
    namespace App\Http\Middleware;
    use \App\Session\Admin\SessionLogin;

    class RequireAdminLogout{
        
        /**
         * Método responsável por executar o middleware
         * @param Request $request
         * @param Closure $next
         * @return Response
         */
        public function handle($request, $next){
            //VERIFICA SE O USUÁRIO ESTÁ LOGADO
            if (SessionLogin::isLogged()){
                $request->getRouter()->redirect('/admin');
            }
            return $next($request);
        }
    }