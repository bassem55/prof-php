<?php
class task
{
    private $name;
    private $pass;
    private $table_name;

    private $con ;

    private $error;
    
    public function __construct($server_name , $db_user , $db_pass , $db_name)
    {
        $this->con = new mysqli($server_name , $db_user , $db_pass , $db_name);
    }
    public function login($username , $pass , $tabe_name)
    {
        $this->name = $username;
        $this->pass = $pass;
        $this->table_name = $tabe_name;
        //we want know the input email or phone number
        //we will allow gmail and yahoo emails and we can allow any email type by add condition on if
        if($this->is_email($username,"gmail.com") || $this->is_email($username , "yahoo.com"))
        {

            $email = $this->name;
            if($this->check_pass($this->pass) == "good")//if pass just number and chars
            {
                $select = $this->con->query("SELECT  password FROM ".$this->table_name." WHERE email ='" . $email . "' AND password ='" . $this->pass . "'");

                if ($select->num_rows == 1) 
                {
                    return "correct";
                } 
                else
                    return "wrong";
            }
            else if ($this->check_pass($this->pass) == "names" || $this->check_pass($this->pass) == "tag" || $this->check_pass($this->pass) == "special")
            {
                $select = $this->con->query('SELECT  password FROM '.$this->table_name.' WHERE email ="' . $email . '"');
                if ($select->num_rows == 1)
                {
                    while ($row = $select->fetch_assoc())
                    {
                        if ($row['password'] == $this->pass)
                        {
                            return "correct";
                        }
                    }

                }
                else 
                    return "wrong";
            } 
            else
            {
                return "wrong";
            }
        }
        else if($this->is_phone_number($username))
        {

            if ($this->check_pass($this->pass) === "good")
            {
                $select = $this->con->query('SELECT  password FROM '.$this->table_name.' WHERE phone_number ="' . $username . '"  AND password ="'. $this->pass .'"');

                if ($select->num_rows > 0)
                {
                    return  "correct";
                }
                else
                {
                    return 'wrong';
                }
            }
            //we want to take care if he but any tag in password but not tell him that it is error
            else if ($this->check_pass($this->pass) == "names" || $this->check_pass($this->pass) == "tag" || $this->check_pass($this->pass) == "special")
            {
                $select = $this->con->query('SELECT  password FROM '.$this->table_name.' WHERE phone_number ="' . $username . '"');

                if ($select->num_rows == 1)
                {
                    while ($row = $select->fetch_assoc())
                    {
                        if ($row['password'] == $this->pass)
                            return "correct";
                        else
                            return "wrong";
                    }
                }
                else
                {
                     return "wrong";
                }
            }
            else 
                return "wrong";
                
           
        }
        else
        {
            return "unknown";
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
    private function check_pass($pass)
    {
        if(strlen($pass) > strlen(filter_var($pass , FILTER_SANITIZE_STRING)))
        {
            return "tag";
        }
        else if($this->have_space($pass))
        {
            return "names";
        }
        else if(strlen($pass) > strlen($this->con->real_escape_string($pass)))
        {
          return "special";
        }
        else
            return "good";
    }
    private function have_space($string)
    {
        for($i =0 ;$i < strlen($string);$i++)
        {
            if($string[$i] == " ")
                return true;
        }
        return false;
    }
    
}
?>
