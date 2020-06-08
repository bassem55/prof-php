<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Storage;

use App\tasks_degree;
class tasks_result extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('tasks.tasks_result');
    }
    public function get_data()
    {
        
    }
    private function get_current_task()
    {
        $id = Auth::id();
        $data = tasks_degree::where('id' , $id)->get();

        if(isset($data[0]->task_1_done) && $data[0]->task_1_done  == "0")
        {
            return 1;
            
        }
        else if(isset($data[0]->task_2_done) && $data[0]->task_2_done  == "0")
        {
            return 2;
        }
        else if(isset($data[0]->task_3_done) && $data[0]->task_3_done  == "0")
        {
            return 3;
        }
        else if(isset($data[0]->task_4_done) && $data[0]->task_4_done  == "0")
        {
            return 4;
            
        }
        else if(isset($data[0]->task_5_done) && $data[0]->task_5_done  == "0")
        {
            return 5;
        }
        else
        {
            return "wrong";
        }
    }
    private function upload_task_yet($task_number)
    {
        $id = Auth::id();
        $data = tasks_degree::where('id' , $id)->get();

        if($task_number == "1" && $data[0]->task_1_recive_date =="")
        {
            return "no";
        }
        else if($task_number == "2" && $data[0]->task_2_recive_date =="")
        {
            return "no";
        }
        else if($task_number == "3" && $data[0]->task_3_recive_date =="")
        {
            return "no";
        }
        else if($task_number == "4" && $data[0]->task_4_recive_date =="")
        {
            return "no";
        }
        else if($task_number == "5" && $data[0]->task_5_recive_date =="")
        {
            return "no";
        }
        else 
        {
            return "yes";
        }
    }
    private function first_time_correction($task_number)
    {
        $id = Auth::id();
        $data = tasks_degree::where('id' , $id)->get();

        if($task_number == "1" && $data[0]->task_1_done == "1")
        {
            return "no";
        }
        else if($task_number == "2" && $data[0]->task_2_done == "1")
        {
            return "no";
        }
        else if($task_number == "3" && $data[0]->task_3_done == "1")
        {
            return "no";
        }
        else if($task_number == "4" && $data[0]->task_4_done == "1")
        {
            return "no";
        }
        else if($task_number == "5" && $data[0]->task_5_done == "1")
        {
            return "no";
        }
        else
        {
            return "yes";
        }
        
               
    }
    public function correction(Request $req)
    {
        if($req->has('task_number'))
        {
            $id = Auth::id();
            $data = tasks_degree::where('id' , $id)->get();
            $current_task = $this->get_current_task();

            //check if allow to user correct this task
            //first we will check if user ask about task 4 correction and he still in task 2
            if($current_task >= $req->input('task_number'))
            {
                //secand check if user upload task or no
                if($this->upload_task_yet($req->input('task_number')) == "yes")
                {
                    //finally will check if user first time correct this task
                    //if first time make correction 
                    //if secand time or above just sent the table data like degree and notes
                    if($this->first_time_correction($req->input('task_number')) == "no")
                    {
                        if($req->input('task_number') == "1")
                        {
                            $degree = ($data[0]->task_1_degree / $data[0]->task_1_total_degree ) * 100 ;
                            $notes = $data[0]->task_1_notes ; 
                            if($notes == "none")
                                return "Your Degree :: " . $degree . "%" ;
                            else 
                                return "Your Degree :: " . $degree . "%" . "<br>" . "Notes :: We Try this inputs that maked logic error" . "<br><br>" . $notes;
                            
                        }
                        else if($req->input('task_number') == "2")
                        {
                            $degree = ($data[0]->task_2_degree / $data[0]->task_2_total_degree ) * 100 ;
                            $notes = $data[0]->task_2_notes ; 
                            if($notes == "none")
                                return "Your Degree :: " . $degree . "%" ;
                            else 
                                return "Your Degree :: " . $degree . "%" . "<br>" . "Notes :: We Try this inputs that maked logic error" . "<br><br>" . $notes;
                            
                        }
                        else if($req->input('task_number') == "3")
                        {
                            $degree = ($data[0]->task_3_degree / $data[0]->task_3_total_degree ) * 100 ;
                            $notes = $data[0]->task_3_notes ; 
                            if($notes == "none")
                                return "Your Degree :: " . $degree . "%" ;
                            else 
                                return "Your Degree :: " . $degree . "%" . "<br>" . "Notes :: We Try this inputs that maked logic error" . "<br><br>" . $notes;
                            
                        }
                        else if($req->input('task_number') == "4")
                        {
                            $degree = ($data[0]->task_4_degree / $data[0]->task_4_total_degree ) * 100 ;
                            $notes = $data[0]->task_4_notes ; 
                            if($notes == "none")
                                return "Your Degree :: " . $degree . "%" ;
                            else 
                                return "Your Degree :: " . $degree . "%" . "<br>" . "Notes :: We Try this inputs that maked logic error" . "<br><br>" . $notes;
                            
                        }
                        else if($req->input('task_number') == "5")
                        {
                            $degree = ($data[0]->task_5_degree / $data[0]->task_5_total_degree ) * 100 ;
                            $notes = $data[0]->task_5_notes ; 
                            if($notes == "none")
                                return "Your Degree :: " . $degree . "%" ;
                            else 
                                return "Your Degree :: " . $degree . "%" . "<br>" . "Notes :: We Try this inputs that maked logic error" . "<br><br>" . $notes;
                            
                        }
                    }
                    else
                    {
                        $res = $this->correct_this($req->input('task_number') , $id );

                        if(count($res) == 2)
                        {
                            $degree = $res[0];
                            $notes = $res[1];

                            if($notes == "none")
                                return "Your Degree :: " . $degree . "%" ;
                            else 
                                return "Your Degree :: " . $degree . "%" . "<br>" . "Notes :: We Try this inputs that maked logic error" . "<br><br>" . $notes;
                            
                        }
                        else 
                        {
                            return $res; 
                        }
                            
                    }
                }
                else
                {
                    return "You Does not Upload task yet";
                }
            }
            else
            {
                return "You Still in Task " . $current_task;
            }

        } 
    }
    private function correct_this($task_number , $id )
    {
        $task_name = "task_" .$task_number.'_'.$id . ".php";
        
        require_once storage_path('app/tasks/' . $task_name);
        
        $degree = array();
        $user_degree =0;
        $total_degree =0;
        
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
                $notes = "none";
                if(count($degree) == 3)
                {
                    
                    $error = $degree[2];
    
                    $notes = "[";
                    for($i=0;$i<count($error);$i++)
                    {
                        $notes .= "(" .$error[$i] . ") , ";
                    }
                    $notes .= "]";
                }
                
                $update = "UPDATE tasks_degrees SET task_1_degree = '".$user_degree."' , task_1_total_degree ='".$total_degree."' , task_1_notes ='".$notes."' , task_1_done = '1' WHERE  id ='".$id."'" ;
            
                DB::statement($update);
                $arr = array();
                $arr[0] = ($user_degree / $total_degree) * 100 ; // %100
                $arr[1] = $notes;

                return $arr;
           }
           
        }
        else if($task_number == 2)
        {
            $degree = $this->task_2_correction($task_name);
            if($degree == "error1")
           {
               return "Error Class Not Founded Make Sure That Class Named task";
           }
           else if($degree == "error2")
           {
                return "Error Function Not Founded Make Sure That Function Named check_phonenumber";
           }
           else
           {
            
                $user_degree = $degree[0];
                $total_degree = $degree[1];
                
                $notes = "none";
                if(count($degree) == 3)
                {
                    
                    $error = $degree[2];

                    $notes = "[";
                    for($i=0;$i<count($error);$i++)
                    {
                        $notes .= "(" .$error[$i] . ") , ";
                    }
                    $notes .= "]";
                }
                $update = "UPDATE tasks_degrees SET task_2_degree ='" . $user_degree."' , task_2_total_degree = '".$total_degree."' , task_2_notes ='".$notes."' , task_2_done = '1'  WHERE  id='".$id . "'";
            
                DB::statement($update);
                $arr = array();
                $arr[0] = ($user_degree / $total_degree) * 100 ; // %100
                $arr[1] = $notes;

                return $arr;
            }
            
        }
        else if($task_number == 3)
        {
            $degree = $this->task_3_correction($task_name);

            if($degree == "error1")
            {
                return "Error Class Not Founded Make Sure That Class Named task";
            }
            else if($degree == "error2")
            {
                 return "Error Function Not Founded Make Sure That Function Named check_email";
            }
            else
            {
            
                $user_degree = $degree[0];
                $total_degree = $degree[1];
                
                $notes = "none";
                if(count($degree) == 3)
                {
                    
                    $error = $degree[2];

                    $notes = "[";
                    for($i=0;$i<count($error);$i++)
                    {
                        $notes .= "(" .$error[$i] . ") , ";
                    }
                    $notes .= "]";
                }
                $update = "UPDATE tasks_degrees SET task_3_degree = '".$user_degree."' , task_3_total_degree = '".$total_degree."' , task_3_notes ='".$notes."' , task_3_done = '1'  WHERE  id = '".$id."'" ;
            
                DB::statement($update);
                $arr = array();
                $arr[0] = ($user_degree / $total_degree) * 100 ; // %100
                $arr[1] = $notes;

                return $arr;
            }
        }
        else if($task_number == 4)
        {

            $degree = $this->task_4_correction($task_name);

            if($degree == "error1")
            {
                return "Error Class Not Founded Make Sure That Class Named task";
            }
            else if($degree == "error2")
            {
                 return "Error Function Not Founded Make Sure That Function Named check_password";
            }
            else
            {
                $user_degree = $degree[0];
                $total_degree = $degree[1];
                
                $notes = "none";
                    if(count($degree) == 3)
                    {
                        
                        $error = $degree[2];

                        $notes = "[";
                        for($i=0;$i<count($error);$i++)
                        {
                            $notes .= "(" .$error[$i] . ") , ";
                        }
                        $notes .= "]";
                    }
                $update = "UPDATE tasks_degrees SET task_4_degree = '".$user_degree."' , task_4_total_degree = '".$total_degree."' , task_4_notes ='".$notes."'  , task_4_done = '1' WHERE  id ='".$id."'" ;
            
                DB::statement($update);
                $arr = array();
                $arr[0] = ($user_degree / $total_degree) * 100 ; // %100
                $arr[1] = $notes;

                return $arr;
            }
            
        }
        
        else if($task_number == 5)
        {

            $degree = $this->task_5_correction($task_name);

            if($degree == "error1")
            {
                return "Error Class Not Founded Make Sure That Class Named task";
            }
            else if($degree == "error2")
            {
                 return "Error Function Not Founded Make Sure That Function Named signup";
            }
            else
            {
                $user_degree = $degree[0];
                $total_degree = $degree[1];
                
                $notes = "none";
                    if(count($degree) == 3)
                    {
                        
                        $error = $degree[2];

                        $notes = "[";
                        for($i=0;$i<count($error);$i++)
                        {
                            $notes .= "(" .$error[$i] . ") , ";
                        }
                        $notes .= "]";
                    }
                $update = "UPDATE tasks_degrees SET task_5_degree = '".$user_degree."' , task_5_total_degree = '".$total_degree."' , task_5_notes ='".$notes."' , task_1_done = '5'  WHERE  id ='".$id."'" ;
            
                DB::statement($update);
                $arr = array();
                $arr[0] = ($user_degree / $total_degree) * 100 ; // %100
                $arr[1] = $notes;

                return $arr;
            }
            
        }
        /*
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
        */
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
        $newValue_of_task = ["task"];
        
        
      if(class_exists("task"))
      {
        
        $task = new $newValue_of_task[0];
         if(session()->has('error_class'))
            {
             session()->forget('error_class');
            }
           if(method_exists("task", 'check_name'))
           {
                
               
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
                if(count($notes) > 0)
                    $arr[2] = $notes;
                return $arr;
            
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

    private function task_2_correction($task_name)
    {
        $newValue_of_task = ["task"];
        if(class_exists("task"))
        {
        
            $task = new $newValue_of_task[0];
            if(session()->has('error_class'))
                {
                session()->forget('error_class');
                }
            if(method_exists("task", 'check_phonenumber'))
            {
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
            else
            {
                return "error2";
            }
        }
        else
        {
            return "error1";
        }
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
    private function task_3_correction($task_name)
    {
        $newValue_of_task = ["task"];
        if(class_exists("task"))
        {
        
            $task = new $newValue_of_task[0];
            if(session()->has('error_class'))
                {
                session()->forget('error_class');
                }
            if(method_exists("task", 'check_email'))
            {
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
            else
            {
                return "error2";
            }
        }
        else
        {
            return "error1";
        }

        
        
    }
    private function task_4_correction($task_name)
    {
        $newValue_of_task = ["task"];
        if(class_exists("task"))
        {
        
            $task = new $newValue_of_task[0];
            if(session()->has('error_class'))
                {
                session()->forget('error_class');
                }
            if(method_exists("task", 'check_password'))
            {
                $correct = array();
                $correct[0] = "bassem12";
                $correct[1] = "bassem12345";
                $correct[2] = "<bassemreda55>";
                $correct[3] = "bassem559829";
                $correct[4] = "1234bassem34";
                $correct[5] = "abanoub<>s55";

                $wrong = array();
                $wrong[0] = "12345678";//do not have char
                $wrong[1] = "basemreda";//do not have a number
                $wrong[2] = "bassem5";//7 digit
                $wrong[3] = "";
                $wrong[4] = "marco";
                $wrong[5] = "<><><>";
                $notes = array();
                $counter = 0;

                $degree = 0;
                for($i=0;$i<count($wrong);$i++)
                {
                    if($task->check_password($wrong[$i]) == "wrong")
                    {
                        $degree++;
                    }
                    else if($task->check_password($wrong[$i]) == "correct")
                    {
                        $notes[$counter] = $wrong[$i];
                        $counter++;
                    }   
                }
                for($i=0;$i<count($correct);$i++)
                {
                    if($task->check_password($correct[$i]) == "correct")
                    {
                        $degree++;
                    }
                    else if($task->check_password($correct[$i]) == "wrong")
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
            else
            {
                return "error2";
            }
        }
        else
        {
            return "error1";
        }
    }

    /*
        use last tasks to create function signup that his job
        make validate for inputs and make sure all is vaild

        create class name task 
        and create  function name signup that will take four parameters
        ==>first_name
        ==>last_name
        ==>email
        ==>phone_number
        ==>password
        ==>repassword
        ==>age (any age) 
        
        
        make validation for all parameters

        if everything good  return correct
        
        if atleast one parameter wrong return wrong

    */

    private function task_5_correction($task_name)
    {
        $newValue_of_task = ["task"];
        if(class_exists("task"))
        {
        
            $task = new $newValue_of_task[0];
            if(session()->has('error_class'))
                {
                session()->forget('error_class');
                }
            if(method_exists("task", 'signup'))
            {
                $correct_name = array();
                $correct_name[0] = "abanoub";
                $correct_name[1] = "ali";
                $correct_name[2] = "kero";
                $correct_name[3] = "bassem";
                $correct_name[4] = "namewithoutspace";
                $correct_name[5] = "namewithouttag";

                $correct_email = array();
                $correct_email[0] = "bassemreda55@gmail.com";
                $correct_email[1] = "abanoub@yahoo.com";
                $correct_email[2] = "bassem@yahoo.com";
                $correct_email[3] = "abanoub@gmail.com";
                $correct_email[4] = "kero@yahoo.com";
                $correct_email[5] = "marco@gmail.com";

                $correct_phone = array();

                $correct_phone[0] = "01201873616";
                $correct_phone[1] = "01102764837";
                $correct_phone[2] = "01098237673";
                $correct_phone[3] = "01201873616";
                $correct_phone[4] = "01102764837";
                $correct_phone[5] = "01098237673";

                $correct_password = array();
                $correct_password[0] = "bassem12";
                $correct_password[1] = "bassem12345";
                $correct_password[2] = "<bassemreda55>";
                $correct_password[3] = "bassem559829";
                $correct_password[4] = "1234bassem34";
                $correct_password[5] = "abanoub<>s55";

                $correct_age = array();
                $correct_age[0] = "10";
                $correct_age[1] = "20";
                $correct_age[2] = "22";
                $correct_age[3] = "23";
                $correct_age[4] = "50";
                $correct_age[5] = "70";


                $wrong_name = array();
                $wrong_name[0] = "";
                $wrong_name[1] = "al";
                $wrong_name[2] = "asdryuimngyuioplkjhgd";
                $wrong_name[3] = "bassem55";
                $wrong_name[4] = "bassem reda";
                $wrong_name[5] = "<script>anything</script>";

                $wrong_email = array();
                $wrong_email[0] = "";//empty
                $wrong_email[1] = "bassem reda@gmail.com";//space
                $wrong_email[2] = "bassemreda@anything.com";//not gmail or yahoo
                $wrong_email[3] = "bassem#gmail.com";//# not @
                $wrong_email[4] = "bassem@gmail.com@gmail.com";//@gmail.com written two times
                $wrong_email[5] = "bassem@gmailcom";

                $wrong_phone = array();
                $wrong_phone[0] = "0120287465";//10 
                $wrong_phone[1] = "012028736166";//12
                $wrong_phone[2] = "012012";//6
                $wrong_phone[3] = "01302873616";//12 but start with 013
                $wrong_phone[4] = "01702873616";//12 but start with 017
                $wrong_phone[5] = "012e45mu576";//12 but contain characters


                $wrong_password = array();
                $wrong_password[0] = "12345678";//do not have char
                $wrong_password[1] = "basemreda";//do not have a number
                $wrong_password[2] = "bassem5";//7 digit
                $wrong_password[3] = "";
                $wrong_password[4] = "marco";
                $wrong_password[5] = "<><><>";

                $wrong_age = array();
                $wrong_age[0] = "101";
                $wrong_age[1] = "name";
                $wrong_age[2] = "wrong";
                $wrong_age[3] = "unknown";
                $wrong_age[4] = "9";
                $wrong_age[5] = "70000";

                $degree = 0;
                for($i=0;$i<count($wrong_email);$i++)
                {
                    $result_correct = $task->signup($correct_name[$i] , $correct_name[$i] , $correct_email[$i] , $correct_password[$i] , $correct_age[$i]);
                    $result_wrong   = $task->signup($wrong_name[$i] , $wrong_name[$i] , $wrong_email[$i] , $wrong_password[$i] , $wrong_age[$i]);
                    $notes = array();
                    $counter = 0;
                    if($result_wrong == "wrong")
                    {
                        $degree++;
                    }
                    else
                    {
                        $notes[$counter] =  "(".$wrong_name[$i]." , ".$wrong_name[$i]." , ".$wrong_email[$i]."  , ".$wrong_password[$i]. "  , " . $wrong_age[$i] .")";
                        $counter++;
                    }
                    if($result_correct == "correct")
                    {
                        $degree++;
                    }
                    else if($result_correct == "wrong")
                    {
                        $notes[$counter] =  "(".$correct_name[$i]." , ".$correct_name[$i]." , ".$correct_email[$i]."  , ".$correct_password[$i]. " , " . $correct_age[$i] .")";
                        $counter++;
                    }
                    
                }
                $arr = array();
                $arr[0] = $degree;//degree
                $arr[1] = count($wrong) + count($correct);//total degree 
                $arr[2] = $notes;
                return $arr;

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
    }
}