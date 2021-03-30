<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */
    namespace App\Http;

    class Request{

        /**
         * Método HTTP da requisição
         *@var string
         */
        private $httpMethod;

        /**
         * URI da página
         *@var string
         */
        private $uri;

        /**
         * Parâmetros da URL ($_GET)
         * @var array
         */
        private $queryParams = [];

        /**
         * Variáveis recebidas no POST da página ($_POST)
         * @var array
         */
        private $postVars = [];

        /**
         * Cabeçalho da requisição
         * @var array
         */
        private $headers = [];

        /**
         * Construtor da Classe
         * Class Builder 
         */
        public function __construct(){
            $this->queryParams  = $queryParams ?? [];
            $this->postVars     = $postVars ?? [];
            $this->headers      = getallheaders();
            $this->httpMethod   = $_SERVER['REQUEST_METHOD'] ?? '';
            $this->uri          = $_SERVER['REQUEST_URI'] ?? '';
        }

        /**
         * Método responsável por retornar o método HTTP da requisição
         * Method responsible for returning the HTTP method of the request 
         * @return string
         */
        public function getHttpMethod(){
            return $this->httpMethod;
        }

        /**
         * Método responsável por retornar a URI da requisição
         * Method responsible for returning the request URI 
         * @return string
         */
        public function getUri(){
            return $this->uri;
        }

        /**
         * Método responsável por retornar os Headers da requisição
         * Method responsible for returning the request Headers 
         * @return array
         */
        public function getHeaders(){
            return $this->headers;
        }

        /**
         * Método responsável por retornar os parâmentros da URL da requisição
         * Method responsible for returning the parameters of the request URL 
         * @return string
         */
        public function getQueryParams(){
            return $this->queryParams;
        }

        /**
         * Método responsável por retornar as Variáveis Post da requisição
         * Method responsible for returning the Post Variables of the request 
         * @return array
         */
        public function getPostVars(){
            return $this->postVars;
        }
    }