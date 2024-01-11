<?php
    class Router {
        protected $routes = array();

        public function addRoute(string $method, string $url, callable $target) {
            $this->routes[$method][$url] = $target;
        }

        public function matchRoute() {
            $method = $_SERVER['REQUEST_METHOD'];
            $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

            if (isset($this->routes[$method])) {
                foreach ($this->routes[$method] as $routeUrl => $target) {
                    if ($routeUrl === $url) {
                        if (is_callable($target)) {
                            $target();
                            return;
                        } else {
                            throw new Exception('Invalid route target');
                        }
                    }
                }
            }
            echo '404 Page not found';
        }
    }
?>