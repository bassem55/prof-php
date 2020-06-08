<?php
class task
{
    public function check_phonenumber($phone)
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
                        return "wrong";
                }
                return "correct";
            }
            else 
            {
                return "wrong";
            }
           
        }
        else
            return "wrong";
    }
}
?>