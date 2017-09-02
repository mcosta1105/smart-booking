<?php
    function loadClass($classname){
        $classpath = "classes/".strtolower($classname).".php";
        
        if(is_readable($classpath)){
            include_once($classpath);
        }
        else{
            echo " $classname - Class file does not exist or is unreadable";
        }
    }
    spl_autoload_register('loadClass');
?>