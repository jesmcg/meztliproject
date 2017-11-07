<?php

class Users extends Model{
    protected static $table = "users";

    private $id;
    private $username;
    private $lastname;
    private $mothersname;
    private $email;
    private $password;
    private $date_register;
    private $date_update;
    private $is_admin;
    private $admin_parent;
    
    
    function __construct($id, $username, $lastname, $mothersname, $email, $password, $date_register, $date_update, $is_admin, $admin_parent) {
        $this->id = $id;
        $this->username = $username;
        $this->lastname = $lastname;
        $this->mothersname = $mothersname;
        $this->email = $email;
        $this->password = $password;
        $this->date_register = $date_register;
        $this->date_update = $date_update;
        $this->is_admin = $is_admin;
        $this->admin_parent = $admin_parent;
    }
    
    public function getMyVars(){
        return get_object_vars($this);
    }
    
    function getId() {
        return $this->id;
    }

    function getUsername() {
        return $this->username;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getMothersname() {
        return $this->mothersname;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getDate_register() {
        return $this->date_register;
    }

    function getDate_update() {
        return $this->date_update;
    }

    function getIs_admin() {
        return $this->is_admin;
    }

    function getAdmin_parent() {
        return $this->admin_parent;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    function setMothersname($mothersname) {
        $this->mothersname = $mothersname;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setDate_register($date_register) {
        $this->date_register = $date_register;
    }

    function setDate_update($date_update) {
        $this->date_update = $date_update;
    }

    function setIs_admin($is_admin) {
        $this->is_admin = $is_admin;
    }

    function setAdmin_parent($admin_parent) {
        $this->admin_parent = $admin_parent;
    }
    
}
