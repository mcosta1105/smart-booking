<?php

    /**
     * Class to Validate fields
     */
    class Validation
    {
        
        //Validate $name
        public function checkName($name){
            if(strlen($name)>0 && strlen($name)<16)
            {
                return true;
            }
            else
                return false;
        }
        
        //Validate E-mail
        public function checkEmail($email){
            if(filter_var($email,FILTER_VALIDATE_EMAIL))
            {
                return true;
            }
            else
                return false;
        }
        
        //Validate Phone if is numeric
        public function checkPhone($phone){
            if(is_numeric($phone)){
                return true;
            }
            else
                return false;
        }
        
        //Validate and Compare Passwords
        public function checkPassword($pwd1,$pwd2){
            if(strlen($pwd1)>=8 && $pwd1 == $pwd2)
            {
                return true;
            }
            else
                return false;
        }
    }
?>