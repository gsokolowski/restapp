<?php


class App
{

    // This is default starting point controller/method/parameters setup
    protected $controller = 'home';
    protected $method = 'index';
    protected $data = [];
    protected $controllerFullName = 'homeController';
    protected $requestMethod = 'GET';


    // for request like this home/user/Greg/39/April
    // give me home controller action/method user and parameters name age month

    public function __construct()
    {

        $request = $this->parseRequest();

        echo '<br />';
        var_dump('in construct: ', $request);

        // Requested Controller (HomeController) $request[0]
        // check if requested controller exists
        if (file_exists('../app/controllers/' . $request[0] . 'Controller.php')) {

            // set controller to passed controller in the $request array
            $this->controllerFullName = $request[0] . 'Controller';

            // remove controller from parsed $request array
            unset($request[0]);

        } else {
            echo $request[0] . 'Controller.php  Doesnt exist';
            $location = DOMAIN . 'home/index';
            header('Location: ' . $location);
            exit;
        }


        // and call file controller dynamically e.g. Home
        // '../app/controllers/Home.php';
        require_once '../app/controllers/' . $this->controllerFullName. '.php';
        echo '<br />';
        echo '<br/>current controller is: '.$this->controllerFullName;

        // create new object of class controller e.g. Home
        $this->controller = new $this->controllerFullName();


        // Requested Method (index) $request[1]
        // check if method exists in requested controller class
        if(isset($request[1])) {
            if(method_exists($this->controller, $request[1])) {
                echo '<br />';
                echo 'method exists: ';
                echo $request[1];
                echo '<br />';
                $this->method = $request[1];
                unset($request[1]);
            }

        }

        // at this point you have set controller method and params
        // so you can call you controller now
        // userController($data)

        call_user_func_array([$this->controller, $this->method], $this->data);

    }


    public function parseRequest() {


        echo $_SERVER['REQUEST_METHOD'].'--metoda<br />';

        // http://mvcfull.local/user/show/Greg/35/April
        if($_SERVER['REQUEST_METHOD'] == 'GET') {

            $this->requestMethod = 'GET';
            // teg rid off white space and remove '/' from beginning and the end of request
            $request = trim($_SERVER['REQUEST_URI'], '/');

            // make sure is $request and not something else
            $request = filter_var($request, FILTER_SANITIZE_URL);

            // explode by '/' to get contorller|method|parameters
            $request = explode('/', $request);


            // Array ( [0] => GET [1] => user [2] => show [3] => Greg [4] => 35 [5] => April )
            echo '<br />';

            return $request;

        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->requestMethod = 'POST';
            $request = trim($_SERVER['REQUEST_URI'], '/');
            // make sure is $request and not something else
            $request = filter_var($request, FILTER_SANITIZE_URL);

            // explode by '/' to get contorller|method|parameters
            $request = explode('/', $request);


            // Array ( [0] => GET [1] => user [2] => show [3] => Greg [4] => 35 [5] => April )

            echo '<br />';
            var_dump($request);

            //echo $_SERVER["CONTENT_TYPE"];
            // data type on postmann: form_data or x-www-url-encode
            // data[category_id] = 5
            // data[name] = Marek
            // data[nationality] = Polish
            // data[age] = 32

            echo '<br />';
            var_dump('data in app.php', $_POST['data'] );

            $data = $_POST['data'];
            echo '<br />';
            var_dump('Data again', $data );
            $this->data = $data;
            return $request;
        }

        if($_SERVER['REQUEST_METHOD'] == 'PUT') {

            $this->requestMethod = 'PUT';
            $request = trim($_SERVER['REQUEST_URI'], '/');
            // make sure is $request and not something else
            $request = filter_var($request, FILTER_SANITIZE_URL);

            // explode by '/' to get contorller|method|parameters
            $request = explode('/', $request);


            // Array ( [0] => UPDATE [1] => user [2] => show [3] => Greg [4] => 35 [5] => April )

            var_dump($request);

            echo $_SERVER["CONTENT_TYPE"];

            $xwwwurlencoded = file_get_contents("php://input");
            $data = array();
            parse_str($xwwwurlencoded, $data);

            // data type on postmann: form_data or x-www-url-encode
            // data[category_id] = 5
            // data[name] = Marek
            // data[nationality] = Polish
            // data[age] = 32

            echo '<br />';
            var_dump('Data', $data );

            return $request;
        }

        if($_SERVER['REQUEST_METHOD'] == 'DELETE') {

            $this->requestMethod = 'DELETE';
            $request = trim($_SERVER['REQUEST_URI'], '/');
            // make sure is $request and not something else
            $request = filter_var($request, FILTER_SANITIZE_URL);

            // explode by '/' to get contorller|method|parameters
            $request = explode('/', $request);


            // Array ( [0] => DELETE [1] => user [2] => show [3] => Greg [4] => 35 [5] => April )

            var_dump($request);

            //echo $_SERVER["CONTENT_TYPE"];
            // data type on postmann: form_data or x-www-url-encode
            // data[category_id] = 5
            // data[name] = Marek
            // data[nationality] = Polish
            // data[age] = 32

            echo '<br />';
            var_dump( $_POST['data'] );

            return $request;
        }

    }

}