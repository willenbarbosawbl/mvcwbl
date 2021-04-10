<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */

    namespace App\Controller\Admin;
    use \App\Utils\View;
    use \App\Model\Entity\Admin\User;
    use \App\Session\Admin\SessionLogin;

    class Login extends Page{

        public static function Status($typeMessage, $Message){
            switch($typeMessage){
                case 'error':
                    $status = View::render("admin/messages/error",[
                        "message" => $Message
                    ]);
                    return $status;
                break;
                default:
                    return '';
                break;
            }
        }

        /**
         * Método responsável por retornar a renderização da página de login
         * @param Request $request
         * @return String
         */
        public static function getLogin($request, $typeMessage = null, $Message = null){
            //CONTEÚDO DA PÁGINA DE LOGIN
            $content = View::render('admin/login',[
                "status" => self::Status($typeMessage, $Message)
            ]);
            //RETORNA A PÁGINA COMPLETA
            return parent::getPage('Login >> WBL', $content);
        }

        /**
         * Método responsável por definir o login do usuário
         * @param Request $request
         * @return void
         */
        public static function setLogin($request){
            //Pots Vars
            $postVars = $request->getPostVars();
            $EMAIL = $postVars['email'] ?? '';
            $SENHA = $postVars['senha'] ?? '';
            if ($EMAIL === '' || $SENHA === ''){
                die('usuário e senha inválidos!');
            }

            //BUSCA USUÁRIO PELO EMAIL
            $obUser = User::getUserByEmail($EMAIL);
            
            if (!$obUser instanceof User){
                return self::getLogin($request, "error", 'Email e/ou Senha Inválidos!');
            }

            //VERIFICA A SENHA DO USUÁRIO
            if (!password_verify($SENHA, $obUser->PASS)){
                return self::getLogin($request, "error", 'Email e/ou Senha Inválidos!');
            }

            //VERIFICA SE O SECRET
            if (!password_verify($EMAIL.'-'.$SENHA, $obUser->SECRET)){
                return self::getLogin($request, "error", 'Não foi possível validar usuário!');
            }

            //VERIFICA SE USUÁRIO ESTÁ ATIVO
            if ($obUser->ACTIVE !== "s"){
                return self::getLogin($request, "error", 'Não foi possível validar usuário!');
            }

            //CRIA A SESSÃO DE LOGIN
            SessionLogin::Login($obUser);

            $request->getRouter()->redirect('/admin');

        }

        /**
         * Método responsável por deslogar o usuário
         * @param Request $request
         * @return void
         */
        public static function getLogout($request){
            SessionLogin::Logout();

            $request->getRouter()->redirect('/admin/login');
        }

    }