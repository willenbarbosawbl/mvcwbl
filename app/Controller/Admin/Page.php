<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */

    namespace App\Controller\Admin;
    use \App\Utils\View;

    class Page{

        /**
         * Método responsável por retornar o conteúdo (view) da nossa página genérica
         * Method responsible for returning the content (view) of our generic page
         * @return string
         */
        public static function getPage($title, $content, $vars = []){
            return View::render('admin/page',[
                "title" => $title,
                "content" => $content,
            ]);
        }            

    }