<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Users_bl {
     public static function crearSesion(Users $usr){
        Session::set("username", $usr->getUsername());
        Session::set("idUser", $usr->getId());
    }  
    public static function cerrarSesion(){
        
        Session::remove("username");
        Session::remove("idUser");
        
    }
    public static function login(Users $usr,$password){
           if($usr->getPassword() == $password){
               $r["error"] = 0;
               self::crearSesion($usr);
           }else{
               $r["error"] = 1;
           }
           return $r;
    }
}