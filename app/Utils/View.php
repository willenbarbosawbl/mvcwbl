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