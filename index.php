<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */

     require_once __DIR__."/vendor/autoload.php";

     use \App\Controller\Pages\Home;

     echo Home::getHome();