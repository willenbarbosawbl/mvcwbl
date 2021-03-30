<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */
    namespace App\Http;
    
    class Response{

        /**
         * Códido Status HTTTP
         * @var integer
         */
        private $httpCode = 200;
        
        /**
         * Cabeçalho do Response
         * @var array
         */
        private $headers = [];

        /**
         * Tipo de Conteúdo que está sendo retornado
         * @var string
         */
        private $contentType = 'text/html';

        /**
         * Conteúdo do Response
         * @var mixed
         */
        private $content;

        /**
         * Método responsável por iniciar a classe e definir os valores 
         * Method responsible for starting the class and setting the values 
         * @param integer $httpCode
         * @param mixed $content
         * @param string $contentType
         */
        public function __construct($httpCode, $content, $contentType = 'text/html'){
            $this->httpCode = $httpCode;
            $this->content = $content;    
            $this->setContentType($contentType);
        }

        /**
         * Método responsável por alterar o content type do response
         * Method responsible for changing the content type of the response 
         * @param string $contentType
         * @return void
         */
        public function setContentType($contentType){
            $this->contentType = $contentType;
            $this->addHeader('Content-Type', $contentType);
        }

        /**
         * Método responsável por adicionar um registro no cabeçalho do response.
         * Method responsible for adding a record in the response header. 
         * @param string $key
         * @param string $value
         * @return void
         */
        public function addHeader($key, $value){
            $this->headers[$key] = $value;
        }

        /**
         * Método responsável por enviar a resposta para o usuário
         * Method responsible for sending the response to the user 
         */
        public function sendResponse(){
            //Envia os Headers
            $this->sendHeaders();
            //Imprimi o Conteúdo
            switch($this->contentType){
                case 'text/html':
                    echo $this->content;
                    exit;   
                break;
            }
        }

        /**
         * Método responsável por enviar os headers para o navegador
         * Method responsible for sending the headers to the browser 
         */
        private function sendHeaders(){
            //Status
            http_response_code($this->httpCode);
            //Enviar Headers
            foreach($this->headers as $key=>$value){
                header($key.': '.$value);
            }
        }
    }