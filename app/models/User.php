<?php


// user belongs to category
class User extends Model {

    public $id;
    public $category_id;
    public $name;
    public $nationality;
    public $age;

    protected $db;

    // you should setters and getters here for each property so yoo will not need to pass params through postUser()
    // you would be able to set them in controller and then get them here as $this->name, $this->nationality etc.

    public function getAllUsers() {
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = " select * from users ";
        //echo $sql;
        $query = $this->db->prepare($sql);
        $query->execute(array());
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
        //return json_encode($data);
    }

    public function getUserByName($name) {
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = " select * from users where name like ?";
        echo $sql;
        $query = $this->db->prepare($sql);
        $query->execute(array($name));
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data;
        //return json_encode($data);
    }


    public function storeUser($data) {
        var_dump('data in model: '. $data);

//        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        $sql = "INSERT INTO users (category_id, name, nationality, age ) values(?, ?, ?, ?)";
//        echo $sql;
//        $query = $this->db->prepare($sql);
//        return $query->execute(array($category_id, $name, $nationality, $age));

    }

    public function deleteUser($id) {

    }

    public function updateUser($id) {

    }
}