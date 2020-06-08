<?php

    class task
    {
        public function check_name($name)
        {
            $l1 = strlen($name);
            $l2 = strlen(filter_var($name , FILTER_SANITIZE_STRING));
            if($name == "")
            {
                return "wrong";
            }
            else if($l1 > $l2)//it is meaning the name include tag
            {
                return "wrong";
            }
            else if($this->have_space($name))//it is meaning that the name have many words
            {
                return "wrong";
            }
            else if($this->have_num($name))//it is meaning the the name have a number
            {
                return "wrong";
            }
            else if($l1 < 3 || $l1 > 20)
                return "wrong";
            else
                return "correct";
        }
        private function have_space($string)//return true if the name have space
        {
            for($i =0 ;$i < strlen($string);$i++)
            {
                if($string[$i] == " ")
                    return true;
            }
            return false;
        }
        private function have_num($name)//return true if the name have num
        {
            for($i=0;$i<strlen($name);$i++)
            {
                if(filter_var($name[$i] , FILTER_VALIDATE_INT))
                    return true;
                else
                    continue;
            }
            return false;
        }
        
    }
    
?>