<?php


class Users_controller extends Controller {
    function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $usrCtrlr = new Users_controller();
        $this->view->usrCtrlr = $usrCtrlr;
        
        $this->view->render($this,"index","Generic POS");
    }
    
    public function createUser(){
        $this->view->render($this,"adduserForm","Add user");
    }
    public function register(){
        $keys = Users::getKeys();
        
        print_r($keys);
        
        unset($keys[0]);
        unset($keys[6]);
        unset($keys[7]);
        unset($keys[8]);
        unset($keys[9]);
        
        $date_register = date("Y-m-d");
        $_POST["id"] = NULL;
        $_POST["date_register"] = $date_register;
        $_POST["date_update"] = NULL;
        $_POST["is_admin"] = 1;
        $_POST["admin_parent"] = NULL;
        
        $this->validateKeys($keys, filter_input_array(INPUT_POST));
        $user = Users::instanciate($_POST);
        
        $r = $user->create();
        
        echo json_encode($r);
        
        if($r["error"] == 0){
            Users_bl::crearSesion($user);
        }
        

    }
    
    public function LogOut(){
        Users_bl::cerrarSesion();
    }
    
    public function loginSinup(){
        $this->view->render($this,"loginsinup","Generic POS | Login");
    }
    
    public function Login(){
        if(filter_input(INPUT_POST, "email") != null && filter_input(INPUT_POST, "password") != null){
            $usr = Users::getBy("email", filter_input(INPUT_POST, "email"));
            if(!is_null($usr)){
                $r = json_encode(Users_bl::login($usr,filter_input(INPUT_POST, "password")));
                echo $r;
            }
            
        }
    }
    
    public function ValidateEmail($email, $ajax = true){
        
            $r = Users::getBy("email", $email);
            
            
            if($ajax){
                $r = (empty($r)) ? 0 : 1;
                echo $r;
            }else{
                $r = (empty($r)) ? 0 : $r;
                return $r;
            }
    }
    
    public function getAllUser(){
         $r = Users::getAll();
         
         print_r($r);
    }
    public function getUserBy($id){
        $r = Users::getById($id);
        
        print_r($r);
    }
    
}
