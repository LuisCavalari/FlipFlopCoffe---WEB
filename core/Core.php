<?php
class Core {
    public function run() {
        $params = array();
        $url = "/";
        if (isset($_GET['url'])) {
            $url .= $_GET['url'];
        }
        
        if(!empty($url) && $url!='/'){
            $url = explode("/",$url);
            array_shift($url);
            $currentController = $url[0]."Controller";
            array_shift($url);
            if(!empty($url[0])){
                $currentAction = $url[0];
                array_shift($url);
            }
            else{

                $currentAction = "index";
            }
            if(count($url)>0)
                $params = $url;
            
        }else{
            $currentController = "loginController";
            $currentAction = "index";
        }
        $controler = new $currentController();
        call_user_func_array(array($controler,$currentAction),$params);
    }
}
