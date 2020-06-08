<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Storage;

use App\tasks_degree;
class tasks extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $res = $this->get_current_task();
        return view('tasks.tasks')->with("task" , $res);
    }
    private function get_current_task()
    {
        $id = Auth::id();
        $data = tasks_degree::where('id' , $id)->get();


        $date  = date('Y-m-d');
        
        if(isset($data[0]->task_1_done) && $data[0]->task_1_done  == "0")
        {
            $task_1 = "Your first task :- <br>  
            the task :: (name validation) <br>
            Create class named task contain <br>
            function named check_name <br> 
            that have one  paramter named name <br>
                return correct if name not empty , <br>
                                     name length >= 3 and <=20 , <br>
                                     name do not have a number , <br>
                                     name do not have any space , <br>
                                     name do not have any tag , <br>
                                            
                  return wrong if any thing else .";

            if($data[0]->task_1_sent_date == "")
            {
                $update = "UPDATE tasks_degrees SET task_1_sent_date = '".$date."'  WHERE  id ='".$id."'" ;
            
                DB::statement($update);
            }
            return $task_1;
            
        }
        else if(isset($data[0]->task_2_done) && $data[0]->task_2_done  == "0")
        {
            $task_2 = "Your secand task <br>
            the task :: (phone number validation) <br> 
            Create class named task contain <br>
            function named check_phonenumber <br>
            that have one paramter (phone number) <br>
            the function  will return correct <br>
                if the length of phone number 11  ,<br>
                    will start with 010 or 012 or 011 , <br>
                    make sure that the number not contain any character , <br>
            return wrong if anything else";

            if($data[0]->task_2_sent_date == "")
            {
               
                $update = "UPDATE tasks_degrees SET task_2_sent_date = '".$date."'  WHERE  id ='".$id."'" ;
            
                DB::statement($update);
                
            }
            return $task_2;
        }
        else if(isset($data[0]->task_3_done) && $data[0]->task_3_done  == "0")
        {
            $task_3 = "Your therd task <br>
            the task :: (email validation) <br>
            write class named task that contain <br>
            function name check_email <br>
            that have  one parameter (email) <br>
            return correct if vaild email , <br>
                              email is @gmail.com or @yahoo.com , <br>
                              make sure that email do not have any space , <br>
                              make sure that not empty email , <br>
            return wrong if any thing else";

            if($data[0]->task_3_sent_date == "")
            {
                $update = "UPDATE tasks_degrees SET task_3_sent_date = '".$date."'  WHERE  id ='".$id."'" ;
            
                DB::statement($update);
                
            }
            return $task_3;
        }
        else if(isset($data[0]->task_4_done) && $data[0]->task_4_done  == "0")
        {
            $task_4 = "Your fourth task <br>
            the task :: ( password validation ) <br>
            create class name task that contain <br> 
            function named check_password that have one parameter (password) <br>
            
            return correct if password have digits more than 8 digit , <br>
                              password have numbers and character , <br>
                              password not empty  <br>
            reurn wrong if anything else";

            if($data[0]->task_4_sent_date == "")
            {
                $update = "UPDATE tasks_degrees SET task_4_sent_date = '".$date."'  WHERE  id ='".$id."'" ;
            
                DB::statement($update);
                
            }
            return $task_4;
        }
        else if(isset($data[0]->task_5_done) && $data[0]->task_5_done  == "0")
        {
            $task_5 = "Your Fivth task <br>
            the task :: ( signup ) <br>
            use last tasks to create class name task that contain <br> 
            function named signup that have 7 parameters <br>
            ==>first_name <br>
            ==>last_name <br>
            ==>email <br>
            ==>phone_number <br>
            ==>password <br>
            ==>repassword <br>
            ==>age ::  more than 10 and less that 100 <br>
            return correct if all inputs vaild <br>
            reurn wrong if atleast one parameter wrong";

            if($data[0]->task_5_sent_date == "")
            {
                $update = "UPDATE tasks_degrees SET task_5_sent_date = '".$date."'  WHERE  id ='".$id."'" ;
            
                DB::statement($update);
                
            }
            return $task_5;
        }
        else if(!isset($data[0]->task_1_done))
        {
            //it is meaning that is first visit to tasks page and user donot have record in database
        
            $tasks_table = new tasks_degree();
            $tasks_table->task_1_sent_date = $date;
            $tasks_table->id = $id;
            $tasks_table->save();
            
            $task_1 = "Your first task :- <br>
            the task :: (name validation) <br> 
            Create class named task contain <br> 
            function named check_name that have one  paramter named name <br>
                return correct if name not empty , <br>
                                     name length >= 3 and <=20 , <br>
                                     name do not have a number , <br>
                                     name do not have any space , <br>
                                     name do not have any tag , <br>
                                            
                  return wrong if any thing .";
            
            return $task_1;
        }
    } 
}
