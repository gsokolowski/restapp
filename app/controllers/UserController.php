<?php


class UserController extends Controller
{
    // default method index that we call
    public function index($name = '') {


        echo '<br /><br />USER COTROLLER<br /><br />';

        // GET
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            echo '<br /><br />GEEETT<br />';

            // passed by url
            echo 'name '.$name.'<br/>';

            // User - instantiate object user
            $user = $this->model('User');
            $userData = $user->getUserByName($name);
            var_dump('<br />Show userData: ',$userData);


            // Category - instantiate object category
            $category = $this->model('Category');
            $categoryData = $category->getCategoryById($userData['category_id']);
            var_dump($categoryData);

            echo '<br />'.$categoryData['name'];

            // user/index in view is a path to view/home/index
            $this->view('user/index', [
                'id' => $userData['id'],
                'category' => $categoryData['name'],
                'name' => $userData['name'],
                'nationality' => $userData['nationality'],
                'age' => $userData['age'],
            ]);

        }
    }

    public function store($data) {

        var_dump('store', $data);
        //POST from POSTMEN as x-www-form-urlencoded
//        if($_SERVER['REQUEST_METHOD'] == 'POST') {
//            echo '<br /><br />POOOST<br />';
//            $postData = file_get_contents('php://input');
//            print_r($postData);
//            echo '<br />';
//
//
//            $data = array();
//            parse_str($postData, $data);
//            var_dump($data);
//
//
//
//            $user = $this->model('User');
//            $response = $user->storeUser($data);
//
//            if($response) {
//                http_response_code(200);
//            } else {
//                http_response_code(500);
//            }
//        }

    }

    public function delete() {

        //DELETE
        if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            echo '<br /><br />DELETE<br />';
            $rawdata = file_get_contents('php://input');
            print_r($rawdata);
            echo '<br />';
        }

    }

    public function update() {

        //PUT
        if($_SERVER['REQUEST_METHOD'] == 'PUT') {
            echo '<br /><br />PUT<br />';
            $rawdata = file_get_contents('php://input');
            print_r($rawdata);
            echo '<br />';
        }

    }



}