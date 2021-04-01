<?php
    /**
     * Project Name: MVC WBL
     * Project Year: 2021
     * Project Author: Willen Barbosa
     * Project URL: https://github.com/willenbarbosawbl/mvcwbl 
     */
    namespace App\Http;

    use \Closure;
    use \Exception;
    use \ReflectionFunction;

    class Router{

        /**
         * URL completa do projeto (raiz)
         * @var string
         */
        private $url = '';

        /**
         * Prefixo de todas as rotas
         * @var string
         */
        private $prefix = '';

        /**
         * Índice de rotas
         * @var array
         */
        private $routes = [];

        /**
         * Instância de Request
         * @var request
         */
        private $request;

        /**
         * Método responsável por iniciar a classe
         * Method responsible for starting the class 
         * @param strin $url
         */
        public function __construct($url){
            $this->request  = new Request($this);
            $this->url      = $url;
            $this->setPrefix();
        }

        /**
         * Método responsável por definir o prefixo das rotas
         * Method responsible for defining the prefix of routes 
         */
        private function setPrefix(){
            //Informações da Url Atual
            $parseUrl = parse_url($this->url);

            //Define o prefixo
            $this->prefix = $parseUrl['path'] ?? '';
        }

        /**
         * Método responsável por adicionar uma rota na classe
         * Method responsible for adding a route to the class 
         * @param string $method
         * @param string $route
         * @param array $params
         */
        private function addRoute($method, $route, $params = []){
            //Validação dos Parâmetros     
            foreach($params as $key=>$value){
                if ($value instanceof Closure){
                    $params['controller'] = $value;
                    unset($params[$key]);
                    continue;
                }
            }

            //Variáveis da rota
            $params['variables'] = [];

            //Padrão de validação de variáveis das rotas
            $patternVariable = '/{(.*)}/';
            if (preg_match_all($patternVariable, $route,$matches)){
                $route = preg_replace($patternVariable, '(.*?)', $route);
                $params['variables'] = $matches[1];
            }

            //Padrão de validação da URL
            $patternRoute = '/^'.str_replace('/', '\/', $route).'$/';

            //Adiciona a rota dentro da classe
            $this->routes[$patternRoute][$method] = $params;            
        }

        /**
         * Método responsável por definir uma rota de GET
         * Method responsible for defining a GET route 
         * @param string $route
         * @param array $params
         */
        public function get($route, $params = []){
            return $this->addRoute('GET', $route, $params);
        }

        /**
         * Método responsável por definir uma rota de POST
         * Method responsible for defining a POST route 
         * @param string $route
         * @param array $params
         */
        public function post($route, $params = []){
            return $this->addRoute('POST', $route, $params);
        }   

        /**
         * Método responsável por definir uma rota de PUT
         * Method responsible for defining a PUT route 
         * @param string $route
         * @param array $params
         */
        public function put($route, $params = []){
            return $this->addRoute('PUT', $route, $params);
        }

        /**
         * Método responsável por definir uma rota de DELETE
         * Method responsible for defining a DELETE route 
         * @param string $route
         * @param array $params
         */
        public function delete($route, $params = []){
            return $this->addRoute('DELETE', $route, $params);
        }

        /**
         * Método responsável por retornar os dados da rota atual
         * Method responsible for returning data from the current route
         * @return array
         */
        private function getRoute(){
            //URI
            $uri = $this->getUri();
            //Method
            $httpMethod = $this->request->getHttpMethod();

            // Valida as Rotas
            foreach($this->routes as $patternRoute=>$methods){
                //Verifica a URI bate com o padrão
                if (preg_match($patternRoute, $uri, $matches)){
                    //Verifica o método
                    if (isset($methods[$httpMethod])){
                        //Remove a primeira posição
                        unset($matches[0]);

                        //Variáveis processadas
                        $keys = $methods[$httpMethod]['variables'];
                        $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                        $methods[$httpMethod]['variables']['request'] = $this->request;

                        //Retorno do parâmetros da rota
                        return $methods[$httpMethod];
                    }
                    throw new Exception('Método não é permitido!', 405);
                }                
            }

            throw new Exception('URL não encontrada!', 404);
            /*echo '<pre>';
            print_r($httpMethod);
            echo '</pre>'; exit;*/
        }

        /**
         * Método responsável por retornar a URI desconsiderando o prefixo
         * Method responsible for returning the URI regardless of the prefix 
         * @return string
         */
        private function getUri(){
            //URI da Request
            $uri = $this->request->getUri();
            //Fatia a URI com o prefixo
            $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
            //Retorna a URI sem prefixo
            return end($xUri);
        }

        /**
         * Método responsável por retornar a URL atual
         * @return string
         */        
        public function getCurrentUrl(){
            return $this->url.$this->getUri();     
        }

        /**
         * Método responsável por executar a rota atual
         * Method responsible for executing the current route 
         * @return Response
         */
        public function run(){
            try{
                //Obtém a rota atual
                $route = $this->getRoute();
                //Verifica o controlador
                if (!isset($route['controller'])){
                    throw new Exception('A URL não pode ser processada!', 500);
                }
                //Argumento da função
                $args = [];

                //Reflection
                $reflection = new ReflectionFunction($route['controller']);
                foreach($reflection->getParameters() as $parameter){
                    $name = $parameter->getName();    
                    $args[$name] = $route['variables'][$name] ?? '';
                }

                //Retorna a execução da função
                return call_user_func_array($route['controller'], $args);
            }catch(Exception $e){
                return new Response($e->getCode(), $e->getMessage());
            }
        }
    }