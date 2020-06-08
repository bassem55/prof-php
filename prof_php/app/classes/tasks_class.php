<?php 
namespace App\classes;

use Illuminate\Support\Facades\DB;
    class tasks_class
    {
        public function get_task($id)
        {
            $data = DB::table("tasks_degree")->where("id" , $id)->get();

            foreach($data as $mini_data)
            {
                if($mini_data->task_1_done == 0)
                {
                    //it is meaning that is first task for user
                    //display first task 

                }
                else if($mini_data->task_2_done == 0)
                {

                }
                else if($mini_data->task_3_done == 0)
                {
                    
                }
                else if($mini_data->task_4_done == 0)
                {
                    
                }
                else if($mini_data->task_5_done == 0)
                {
                    
                }
                else if($mini_data->task_6_done == 0)
                {
                    
                }
                else if($mini_data->task_7_done == 0)
                {
                    
                }
                else if($mini_data->task_8_done == 0)
                {
                    
                }
                else
                {
                    //it meaning that user finish all tasks
                }
            }
        }
    public function correct_this($task_number , $id , $recive_date_of_tak)
    {
        
        
        $task_name = "task_" .$id.'_'.$task_number . ".php";
        $path_file = public_path('tasks\\'). $task_name;

        require_once public_path('tasks\\') . $task_name;

        $degree = array();
        $user_degree =0;
        $total_degree =0;

        //first we will store in database that the user recive a task
        $insert = "UPDATE tasks_degree SET task_".$task_number."_recive_date='" . $recive_date_of_tak."' WHERE id='" . $id . "'";
        DB::statement($insert);
        if($task_number == 1)
        {
            
           $degree =  $this->task_1_correction($task_name);
           if($degree == "error1")
           {
               return "Error Class Not Founded Make Sure That Class Named task";
           }
           else if($degree == "error2")
           {
                return "Error Function Not Founded Make Sure That Function Named check_name";
           }
           else
           {
                $user_degree = $degree[0];
                $total_degree = $degree[1];
                $error = $degree[2];
    
                $notes = "[";
                for($i=0;$i<count($error);$i++)
                {
                    $notes .= "(" .$error[$i] . ") , ";
                }
                $notes .= "]";
                $update = "UPDATE tasks_degree SET task_1_degree = '".$user_degree."' , task_1_total_degree ='".$total_degree."' , task_1_notes ='".$notes."' WHERE  id ='".$id."'" ;
            
                DB::statement($update);
           }
           
        }
        else if($task_number == 2)
        {
            $degree = $this->task_2_correction($path_file);
            $user_degree = $degree[0];
            $total_degree = $degree[1];
            $error = $degree[2];
            $notes = "[";
            for($i=0;$i<count($error);$i++)
            {
                $notes .= "(" .$error[$i] . ") , ";
            }
            $notes .= "]";
            $update = "UPDATE tasks_degree SET task_2_degree ='" . $user_degree."' , task_2_total_degree = '".$total_degree."' , task_2_notes ='".$notes."'  WHERE  id='".$id . "'";
        
           $this->con->query($update);
            
        }
        else if($task_number == 3)
        {
            $degree = $this->task_3_correction($path_file);
            $user_degree = $degree[0];
            $total_degree = $degree[1];
            $error = $degree[2];
            $notes = "[";
            for($i=0;$i<count($error);$i++)
            {
                $notes .= "(" .$error[$i] . ") , ";
            }
            $notes .= "]";
            $update = "UPDATE tasks_degree SET task_3_degree = '".$user_degree."' , task_3_total_degree = '".$total_degree."' , task_3_notes ='".$notes."'  WHERE  id = '".$id."'" ;
        
           $this->con->query($update);
        }
        else if($task_number == 4)
        {

            $degree = $this->task_4_correction($path_file , $id);
            $user_degree = $degree[0];
            $total_degree = $degree[1];
            $error = $degree[2];
            $notes = "[";
            for($i=0;$i<count($error);$i++)
            {
                $notes .= "(" .$error[$i] . ") , ";
            }
            $notes .= "]";
            $update = "UPDATE tasks_degree SET task_4_degree = '".$user_degree."' , task_4_total_degree = '".$total_degree."' , task_1_notes ='".$notes."'  WHERE  id ='".$id."'" ;
        
           $this->con->query($update);
        }
        else if($task_number == 5)
        {

            $degree = $this->task_5_correction($path_file , $id);
            $user_degree = $degree[0];
            $total_degree = $degree[1];
            $error = $degree[2];
            $notes = "[";
            for($i=0;$i<count($error);$i++)
            {
                $notes .= "(" .$error[$i] . ") , ";
            }
            $notes .= "]";
            $update = "UPDATE tasks_degree SET task_5_degree = '".$user_degree."' , task_5_total_degree = '".$total_degree."' , task_5_notes ='".$notes."'  WHERE  id ='".$id."'" ;
        
           $this->con->query($update);
        }
    }
        /*
     * this first task
     * the task :: class named task and contain function named check_name and have one  paramter named name
     *  return correct if name not empty
     *                 name length >= 3 and <=20 
     *                 name do not have a number 
     *                 name do not have any space
     *                 name do not have any tag
     *                            
     *  return wrong if any thing 
     */
    private function task_1_correction($task_name)
    {
        
        
       /* if(class_exists('task'))
        {
            if(method_exists('task', 'check_name'))
            {
                */
                
                $task = new task();
                $wrong = array();
                $wrong[0] = "";
                $wrong[1] = "al";
                $wrong[2] = "asdryuimngyuioplkjhgd";
                $wrong[3] = "bassem55";
                $wrong[4] = "bassem reda";
                $wrong[5] = "<script>anything</script>";
                $correct = array();
                $correct[0] = "abanoub";
                $correct[1] = "ali";
                $correct[2] = "bassem";
                $notes = array();
                $counter = 0;
                $degree = 0;
                for($i=0;$i<count($wrong);$i++)
                {
                    if($task->check_name($wrong[$i]) === "wrong")
                    {
                        $degree++;
                    }
                    else if($task->check_name($wrong[$i]) === "correct")
                    {
                        $notes[$counter] = $wrong[$i];
                        $counter++;
                    }   
                }
                for($i=0;$i<count($correct);$i++)
                {
                    if($task->check_name($correct[$i]) === "correct")
                    {
                        $degree++;
                    }
                    else if($task->check_name($correct[$i]) === "wrong")
                    {
                        $notes[$counter] = $wrong[$i];
                        $counter++;
                    }
                }
                $arr = array();
                $arr[0] = $degree;//degree
                $arr[1] = count($wrong) + count($correct);//total degree 
                $arr[2] = $notes;
                return $arr;
                /*
            }
            else
            {
                return "error2";
            }
        }
        else
        {
            return "error1";
        }
        */
    }
    /*
        this secand task
        it is about valid phone number
        write in file class named task 
        and function check_phonenumber
        will take one paramter(phone number)
        and will return correct if the length of phone number 11
                                    will start with 010 or 012 or 011
                                    make sure that the number not contain any character
        return wrong if anything else
    */
    private function task_2_correction($path_file)
    {
        require_once $path_file;
        $task = new task();
        $wrong = array();
        $wrong[0] = "0120287465";//10 
        $wrong[1] = "012028736166";//12
        $wrong[2] = "012012";//6
        $wrong[3] = "01302873616";//12 but start with 013
        $wrong[4] = "01702873616";//12 but start with 017
        $wrong[5] = "012e45mu576";//12 but contain characters
        $correct = array();
        $correct[0] = "01201873616";
        $correct[1] = "01102764837";
        $correct[2] = "01098237673";
       
        $degree = 0;
        $notes = array();
        $counter = 0;
        $degree = 0;
        for($i=0;$i<count($wrong);$i++)
        {
            if($task->check_phonenumber($wrong[$i]) == "wrong")
            {
                $degree++;
            }
            else if($task->check_phonenumber($wrong[$i]) == "correct")
            {
                $notes[$counter] = $wrong[$i];
                $counter++;
            }   
        }
        for($i=0;$i<count($correct);$i++)
        {
            if($task->check_phonenumber($correct[$i]) == "correct")
            {
                $degree++;
            }
            else if($task->check_phonenumber($correct[$i]) == "wrong")
            {
                $notes[$counter] = $wrong[$i];
                $counter++;
            }
        }
        $arr = array();
        $arr[0] = $degree;//degree
        $arr[1] = count($wrong) + count($correct);//total degree 
        $arr[2] = $notes;
        return $arr;
    }
    /*
        therd task :: email validation
        write class name task contain public function name check_email
        
        take one parameter (email)
        return correct if vaild email and
                          email is @gmail.com or @yahoo.com
                          make sure that email do not have any space
                          make sure that not empty email
        return wrong if any thing else
    */
    private function task_3_correction($path_file)
    {
        require_once $path_file;
        $task = new task();
        $wrong = array();
        $wrong[0] = "";//empty
        $wrong[1] = "bassem reda@gmail.com";//space
        $wrong[2] = "bassemreda@anything.com";//not gmail or yahoo
        $wrong[3] = "bassem#gmail.com";//# not @
        $wrong[4] = "bassem@gmail.com@gmail.com";//@gmail.com written two times
        $wrong[5] = "bassem@gmailcom";
        $correct = array();
        $correct[0] = "bassemreda55@gmail.com";
        $correct[1] = "abanoub@yahoo.com";
        $correct[2] = "bassem@yahoo.com";
        $notes = array();
        $counter = 0;
        $degree = 0;
        for($i=0;$i<count($wrong);$i++)
        {
            if($task->check_email($wrong[$i]) == "wrong")
            {
                $degree++;
            }
            else if($task->check_email($wrong[$i]) == "correct")
            {
                $notes[$counter] = $wrong[$i];
                $counter++;
            }   
        }
        for($i=0;$i<count($correct);$i++)
        {
            if($task->check_email($correct[$i]) == "correct")
            {
                $degree++;
            }
            else if($task->check_email($correct[$i]) == "wrong")
            {
                $notes[$counter] = $wrong[$i];
                $counter++;
            }
        }
        $arr = array();
        $arr[0] = $degree;//degree
        $arr[1] = count($wrong) + count($correct);//total degree 
        $arr[2] = $notes;
        return $arr;
    }
    }
?>