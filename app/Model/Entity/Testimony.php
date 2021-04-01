<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */

    namespace App\Model\Entity;

    use \WilliamCosta\DatabaseManager\Database;    

    class Testimony{

        /**
         * ID do depoimento
         * @var integer
         */
        public $id;

        /**
         * Nome do usuário que fez o depoimento
         * @var string
         */
        public $name;

        /**
         * Mensagem do depoimento
         * @var string
         */
        public $testimony;

        /**
         * Data de publicação do depoimento
         * @var string
         */
        public $date;

        /**
         * Método responsável por cadastrar a instancia atual no banco de dados
         * @return boolean
         */
        public function register(){
            //DEFINE A DATA
            $this->date = date("Y-m-d H:i:s");
            //INSERI O DEPOIMENTO NO BANCO DE DADOS
            $this->id = (new Database('testimony'))->insert([
                "NAME" => $this->name,
                "TESTIMONY" => $this->testimony,
                "DATE"=>$this->date
            ]);
            return true;
        }

        /**
         * Método responsável por retornar Depoimentos
         * @param string $where
         * @param string $order
         * @param string $limit
         * @param string $fields
         * @return PDOStatement
         */
        public static function getTestimony($where = null, $order = null, $limit = null, $fields = '*'){
            return (new Database('testimony'))->select($where,$order,$limit,$fields);
        }
    }