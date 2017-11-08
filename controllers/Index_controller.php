<?php
/**
 * @author JESUS
 */
class Index_controller extends Controller{
   
    function __construct() {
        parent::__construct();
    }

    public function index(){
        //Users views
        $usrCtrlr = new Users_controller();
        $this->view->usrCtrlr = $usrCtrlr;
        
        
        $indCtrlr = new Index_controller();
        $this->view->indCtrlr = $indCtrlr;
        $this->view->render($this,"index","meztliproject");
    }
    
    public function informationIndex(){
        $this->view->render($this,"informationIndex","meztliproject");
    }
}
