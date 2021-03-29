<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */

    namespace App\Controller\Pages;
    use \App\Utils\View;

    class Page{

        /**
         * Método responsável por renderizar o topo da página
         * Method responsible for rendering the top of the page 
         * @param array (string/numeric) $vars
         * @return string
         */
        private static function getHeader($vars =[]){
            return View::render('pages/header', $vars);
        }

        /**
         * Método responsável por renderizar o rodapé da página
         * Método responsável por renderizar o rodapé da página 
         * @param array (string/numeric) $vars
         * @return string
         */
        private static function getFooter($vars =[]){
            return View::render('pages/footer',$vars);
        }


        /**
         * Método responsável por retornar o conteúdo (view) da nossa página genérica
         * Method responsible for returning the content (view) of our generic page
         * @return string
         */
        public static function getPage($title, $content, $vars = []){
            return View::render('pages/page',[
                "title" => $title,
                "header" => self::getHeader($vars),
                "content" => $content,
                "footer" => self::getFooter($vars)
            ]);
        }        

    }