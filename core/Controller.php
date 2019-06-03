<?php
class Controller{
    private $atendente;
    private $cliente;
    public function loadView($viewName,$params){
        extract($params);
        require 'view/'.$viewName.".php";
    }public function loadDashboard($viewName,$params){
        extract($params);
        require 'view/dashboard.php' ;
    }public function loadReport($reportName,$params){
        extract($params);
        require 'reports/'.$reportName.".php";
    }
}    
?>