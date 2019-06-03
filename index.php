<?php
require 'config.php';
session_start();
spl_autoload_register(function($class){
    if(file_exists("controller/".$class.".php"))
        require "controller/".$class.".php";
    else if(file_exists('model/'.$class.".php"))
        require 'model/'.$class.".php";
    else if(file_exists("core/".$class.".php"))
        require 'core/'.$class.".php";
});
  $core = new Core();
  $core->run();
?>