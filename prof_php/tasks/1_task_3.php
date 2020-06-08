<?php
    class task
    {
        public function check_email($email)
        {
            if(filter_var($email,FILTER_VALIDATE_EMAIL))
            {

                $arr = explode("@",$email);
                if(count($arr) == 2 )
                {
                    if($arr[1] == "gmail.com" || $arr[1] == "yahoo.com")
                        return "correct";
                    else
                        return "wrong";
                }
                else
                    return "wrong";
            }
            else
                return "wrong";

        }
    }
    
?>