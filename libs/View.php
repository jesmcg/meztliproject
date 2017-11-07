<?php
class View {
    
    public function render($controller,$view,$title = ''){
        
        $controller = get_class($controller);
        $controller = substr($controller, 0, -11);
        $path = './views/'.$controller.'/'.$view;
        
        if(file_exists($path.".php")){
            if ($title != "") {
                $this->title = $title;
            }
            require $path.".php";
        }elseif (file_exists($path.".html")) {
            if ($title != "") {
                $this->title = $title;
            }
            require $path.".html";
        }else{
            echo "Error: Invalid view ".$view." to render";
        }
    }    
}
