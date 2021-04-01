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
    use \App\Model\Entity\Testimony;
    use \WilliamCosta\DatabaseManager\Pagination;
    

    class Depoimentos extends Page{


        /**
         * Método responsável por obter a rederização dos itens de depoimentos para a página
         * @param REQUEST $request
         * @return string
         */
        private static function getTestimonyItems($request, &$obPagination){
            $itens = '';

            //QUANTIDADE TOTAL DE REGISTROS
            $quantidadeTotal = Testimony::getTestimony(NULL, NULL, NULL, 'COUNT(*) as qtd')->fetchObject()->qtd;
            
            //PAGINA ATUAL
            $queryParams = $request->getQueryParams();
            $paginaAtual = $queryParams['page'] ?? 1;

            //INSTANCIA DE PAGINAÇÃO
            $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 5);

            //RESULTADOS DA PÁGINA
            $results = Testimony::getTestimony(NULL, 'ID DESC', $obPagination->getLimit());

            //RENDERIZA O ITEM
            while($obTestimony = $results->fetchObject(Testimony::class)){
                $itens .= View::render('pages/testimony/item', [
                    "NAME"=> $obTestimony->NAME,
                    "TESTIMONY"=> $obTestimony->TESTIMONY,
                    "DATE"=> date('d/m/Y H:i:s', strtotime($obTestimony->DATE))
                ]);
            }

            //RETORNA OS DEPOIMENTOS
            return $itens;
        }

        /**
         * Método responsável por retornar o conteúdo (view) da nossa Depoimentos
         * Method responsible for returning the content (view) of our Testimonials 
         * @param REQUEST $request
         * @return string
         */
        public static function getDepoimentos($request){
            $obOrganization = new Organization();
            //View da Home
            $vars = [
                "name" => $obOrganization->name,
                "description" => $obOrganization->description,
                "site" => $obOrganization->site,
                "name_site" => $obOrganization->name_site,
                "dateyear" => date("Y"),
                "itens"=> self::getTestimonyItems($request,$obPagination),
                "pagination"=>parent::getPagination($request,$obPagination)
            ];
            $content = View::render('pages/depoimentos',$vars);

            //Retorna a View da Página
            return parent::getPage("Depoimentos >> MVC WBL", $content, $vars);
        }        

        /**
         * Método responsável por cadastrar um depoimento
         * @param Request $request
         * @return string
         */
        public static function insertTestimony($request){
            //DADOS DO POST
            $postVars = $request->getPostVars();
            
            //NOVA INSTANCIA DE DEPOIMENTO
            $obTestimony = new Testimony();
            $obTestimony->name = $postVars['nome'];
            $obTestimony->testimony = $postVars['depoimento'];
            $obTestimony->register();
            
            //RETORNA A PÁGINA DE LISTAGEM DE DEPOIMENTOS
            return self::getDepoimentos($request);    
        }

    }