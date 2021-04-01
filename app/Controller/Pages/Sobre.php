<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */

    namespace App\Controller\Pages;
    use \App\Utils\View;
    use \App\Model\Entity\Organization;

    class Sobre extends Page{

        /**
         * Método responsável por retornar o conteúdo (view) da nossa sobre
         * Method responsible for returning the content (view) of our about
         * @return string
         */
        public static function getSobre(){
            $obOrganization = new Organization();

            //View da Home
            $vars = [
                "name" => $obOrganization->name,
                "description" => $obOrganization->description,
                "site" => $obOrganization->site,
                "name_site" => $obOrganization->name_site,
                "dateyear" => date("Y")
            ];
            $content = View::render('pages/sobre',$vars);

            //Retorna a View da Página
            return parent::getPage("Sobre >> MVC WBL", $content, $vars);
        }        

    }