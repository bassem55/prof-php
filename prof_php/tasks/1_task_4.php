<?php

class task
{
    private $con;

    private $fn;
    private $ln;
    private $phone;
    private $email;
    private $pass;
    private $repass;
    private $age;
    private $country;
    private $table_name;

    private $error;

    public function __construct($server_name , $db_user , $db_pass , $db_name)
    {
        $this->con = new mysqli($server_name , $db_user , $db_pass , $db_name);
    }
    public function signup($first_name , $last_name , $email,$phone_number, $pass , $repass , $age , $country , $table_name)
    {
        $this->fn = $first_name;
        $this->ln = $last_name;
        $this->email = $email;
        $this->phone = $phone_number;
        $this->pass = $pass;
        $this->repass = $repass;
        $this->age = $age;
        $this->country = $country;
        $this->table_name = $table_name;

        if(($this->is_email($this->email,'gmail.com') === true || $this->is_email($this->email , "yahoo.com") === true ) && $this->is_phone_number($this->phone) === true)
        {

            if($this->get_first_name_error() === "good" && $this->get_last_name_error() === "good"  && $this->get_pass_error() === "good" && $this->pass == $this->repass && $this->age > 0)
            {
                //first we will insert data on sign up table
                $insert_sign_up = "INSERT INTO ".$this->table_name." (first_name , last_name  , email , phone_number , password , age , country) VALUES('".$this->fn."' , '". $this->ln ."' ,'".$this->email."', '".$this->phone."', '".$this->pass."' ,'".$this->age."', '".$this->country."' )";
                $this->con->query($insert_sign_up);

                return "correct";
            }
            else
                return "wrong";

        }
        else
        {
            return "wrong";
        }
    }
    private function is_email($email , $last_part)
    {
        if(filter_var($email,FILTER_VALIDATE_EMAIL))
        {

            $arr = explode("@",$email);
            if(count($arr) == 2 && $arr[1] == $last_part)
            {
                return true;
            }
            else
                return false;
        }
        else
            return false;

    }
    private function is_phone_number($phone)
    {
        if(strlen($phone) == 11)
        {
            $start = $phone[0] . $phone[1] . $phone[2];
            if($start == "012" || $start == "011" || $start == "010")
            {
                for($i = 0; $i < 11 ; $i++)
                {
                    if($phone[$i] == "0" || filter_var($phone[$i] , FILTER_VALIDATE_INT))
                    {
                        continue;
                    }
                    else
                        return false;
                }
                return true;
            }
            else 
            {
                return false;
            }
           
        }
        else
            return false;
    }
    private function get_first_name_error()
    {
        $output = $this->check_name($this->fn);
        if($output === "empty")
        {
            $this->fn_error = "You Should Write Your First Name";
        }
        else if($output === "tag")
        {
            $this->fn_error = "Do Not Write Any Tag Again in Your Name";
        }
        else if($output === "space")
        {
            $this->fn_error = "First Name Should Not start With Space";
        }
        else if($output === "names")
        {
            $this->fn_error = "Just Write One name";
        }
        else if($output === "num")
        {
            $this->fn_error = "You Should Write Your Name Without Numbers";
        }
        else if($output === "good")
        {
            $this->fn_error = "good";
        }
        return $this->fn_error;
    }
    private function get_last_name_error()
    {
        $output = $this->check_name($this->ln);
        if($output === "empty")
        {
            $this->ln_error = "You Should Write Your Last Name";
        }
        else if($output === "tag")
        {
            $this->ln_error = "Do Not Write Any Tag Again in Your Name";
        }
        else if($output === "space")
        {
            $this->ln_error = "Second Name Should Not start With Space";
        }
        else if($output === "names")
        {
            $this->ln_error = "Just Write One name";
        }
        else if($output === "num")
        {
            $this->ln_error = "You Should Write Your Name Without Numbers";
        }
        else if($output === "good")
        {
            $this->ln_error = "good";
        }
        return $this->ln_error;
    }
    private function get_pass_error()//here no errors but we want to make sure that the pass is strong
    {
        if(strlen($this->pass) >= 8)
        {
            if($this->have_num($this->pass))
            {
                $this->pass_error = "good";
            }
            else if($this->have_num($this->pass) !== true)
            {
                $this->pass_error = "Put At Least One Number In Your Password";
            }
        }
        else
            $this->pass_error = "Enter 8 Digit At Least In Your Password";

        return $this->pass_error;

    }
    private function check_name($name)
    {
        $l1 = strlen($name);
        $l2 = strlen(filter_var($name , FILTER_SANITIZE_STRING));
        if($name == "")
        {
            return "empty";
        }
        else if($l1 > $l2)//it is meaning the name include tag
        {
            return "tag";
        }
        else if($this->start_with_space($name))
        {
            return "space";
        }
        else if($this->have_space($name))//it is meaning that the name have many words
        {
            return "names";
        }
        else if($this->have_num($name))//it is meaning the the name have a number
        {
            return "num";
        }
        else
            return "good";
    }
    private function start_with_space($name)
    {
        if($name[0] == " ")
            return true;
        else
            return false;
    }
    private function have_space($string)//return false if the name have space
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

