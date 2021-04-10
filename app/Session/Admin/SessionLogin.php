<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */

    namespace App\Session\Admin;

    class SessionLogin{

        /**
         * Método responsável por iniciar a sessão
         */
        private static function init(){
            //VERIFICA SE A SESSÃO NÃO ESTÁ ATIVA
            if (session_status() !== PHP_SESSION_ACTIVE){                
                session_start();
            }                
        }

        /**
         * Método responsável por criar o Login do usuário
         * @param User $obUser
         * @return boolean
         */
        public static function Login($obUser){
            //INICIA A SESSAO
            self::init();

            $_SESSION['admin']['user'] = [
                "ID" => $obUser->ID,
                "NAME" => $obUser->NAME,
                "SECRET" => $obUser->SECRET
            ];

            return true;
        }

        /**
         * Método responsável por verificar se o usuário está logado
         * @return boolean
         */
        public static function isLogged(){
            self::init();
            return isset($_SESSION['admin']['user']['ID']);
        }

        /**
         * Método responsável por destruir a sessão do usuário;
         * @return boolean
         */
        public static function Logout(){
            self::init();
            unset($_SESSION['admin']['user']);
            return true;
        }
    }