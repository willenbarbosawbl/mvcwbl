<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */

    namespace App\Model\Entity\Admin;

    use \WilliamCosta\DatabaseManager\Database;

    class User{

        /**
         * ID do Usuário
         * @var integer
         */
        public $ID;

        /**
         * Nome do Usuário
         * @var string
         */
        public $NAME;

        /**
         * E-mail do Usuário
         * @var string
         */
        public $EMAIL;

        /**
         * Senha do Usuário
         * @var string
         */
        public $PASS;

        /**
         * Status do Usuário (Sim"s" ou Não "n")
         * @var string
         */
        public $ACTIVE;

        /**
         * Códido secreto do usuário
         * @var string
         */
        public $SECRET;

        /**
         * Data de criação do usuário
         * @var DATE
         */
        public $DATE;

        /**
         * Método responsável por retornar um usuário com base em seu e-mail.
         * @param string $EMAIL
         * @return USERS
         */
        public static function getUserByEmail($EMAIL){
            return (new Database('users'))->select('email = "'.$EMAIL.'"')->fetchObject(self::class);
        }

        

    }