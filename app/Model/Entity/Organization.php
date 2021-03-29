<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */

    namespace App\Model\Entity;

    class Organization{
        
        /**
         * ID da organização
         * @var integer
         */
        public $id = 1;         

        /**
         * Nome da organização
         * @var string
         */
        public $name = "MVC WBL";
        
        /**
         * Site da organização
         * @var string
         */
        public $site = "https://github.com/willenbarbosawbl/mvcwbl";

        /**
         * Descrição da Organização
         * @var string
         */
        public $description = "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vero hic repellendus, dolor vitae iste totam ipsam ipsum inventore, eaque officiis nesciunt perspiciatis tempora saepe error eos illum odio enim consequuntur.";

        public $name_site = "MVC WBL";
    }