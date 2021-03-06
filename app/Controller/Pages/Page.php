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
        
        /**
         * Método responsável por renderizar o layout de páginação
         * @param Request $request
         * @param Paginations $obPagination
         * @return void
         */
        public static function getPagination($request,$obPagination){
            //PÁGINAS
            $pages = $obPagination->getPages();

            //VERIFICA A QUANTIDADE DE PÁGINAS
            if(count($pages) <= 1) return '';
            
            //LINKS 
            $links = '';

            //URL ATUAL (SEM GETS)
            $url = $request->getRouter()->getCurrentUrl();

            //GET
            $queryParams = $request->getQueryParams();

            ///RENDERIZA OS LINKS
            foreach($pages as $page){
                //ALTERA A PÁGINA
                $queryParams['page'] = $page['page'];

                //LINK
                $link = $url.'?'.http_build_query($queryParams);
                
                //VIEW
                $links .= View::render('pages/pagination/link',[
                    "page" => $page['page'],
                    "link" => $link,
                    "active" => $page['current'] ? 'active' : ''
                ]);
            }

            //RENDERIZA BOX DE PAGINAÇÃO
            return View::render('pages/pagination/box',[
                "links" => $links
            ]);

            /*echo '<pre>';
            print_r($queryParams);
            echo '</pre>'; exit;*/
        }

    }