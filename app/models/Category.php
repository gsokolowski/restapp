<?php

class Category extends Model {

    public $id;
    public $name;

    protected $db;

    public function getAllCategories() {
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = " select * from categories ";
        //echo $sql;
        $query = $this->db->prepare($sql);
        $query->execute(array());
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
        //return json_encode($data);
    }

    public function getCategoryById($id) {
        echo 'categiry id'.$id;
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = " select * from categories where id = ? ";
        //echo $sql;
        $query = $this->db->prepare($sql);
        $query->execute(array($id));
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data;
        //return json_encode($data);
    }


    public function postUser($name) {

    }

    public function deleteUser($id) {

    }

    public function updateUser($id) {

    }
}