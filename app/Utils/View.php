<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */

     namespace App\Utils;

     class View{

        /**
         * Varíaveis padrões da View
         * View standard variables 
         * @var array
         */
        private static $vars = [];

        /**
         * Método responsável por definir os dados iniciais da classe
         * Method responsible for defining the initial data of the class 
         * @param array $vars
         */
        public static function init($vars =[]){
            self::$vars = $vars;
        }

        /**
         * Método responsável por retornar o conteúdo de uma view
         * Método responsável por retornar o conteúdo de uma view
         * @param string $view
         * @return string
         */
        private static function getContentView($view){
            $file = __DIR__."/../../resources/view/".$view.".html";
            return file_exists($file) ? file_get_contents($file) : '';
        }   

        /**
         * Método responsável por retornar o conteúdo renderizado de uma view
         * Method responsible for returning the rendered content of a view
         * @param string $view
         * @param array $vars (string/numeric)
         * @return string
         */
        public static function render($view, $vars = []){
            //Conteúdo da View
            $contentView = self::getContentView($view);
            
            //Mescla de variáveis do View
            $vars = array_merge(self::$vars,$vars);

            //Cheves do Array de Variáveis
            $keys = array_keys($vars);
            $keys = array_map(function($item){
                return '{{'.$item.'}}';
            }, $keys);

            $contentView = str_replace($keys, array_values($vars), $contentView);

            //Retornar o Conteúdo Renderizado
            return $contentView;
        }

     }