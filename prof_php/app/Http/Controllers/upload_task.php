<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;

use App\tasks_degree;

use Storage;

class upload_task extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $res = $this->get_current_task();
        if($res == "1")
        {
            $info = "Upload Your First Task";
            
        }
        else if($res == "2")
        {
            $info = "Upload Your Secand Task";
        }
        else if($res == "3")
        {
            $info = "Upload Your Third Task";
        }
        else if($res == "4")
        {
            $info = "Upload Your Fourth Task";
            
        }
        else if($res == "5")
        {
            $info = "Upload Your fifth Task";
        }
        else if($res == "wrong")
        {
            return redirect('/task');
        }
        return view('tasks.upload')->with('info' , $info);
    }
    public function upload_task(Request $request)
    {
        //we will check first about some things 
        
        $id = Auth::id();
        $task_number = $this->get_current_task();

        $data = tasks_degree::where('id' ,$id)->get();

        $wrong = 1;
        if($task_number == "1" && $data[0]->task_1_sent_date != "" && $data[0]->task_1_done == "0")
        {
            $wrong = 0;
        }
        else if($task_number == "2" && $data[0]->task_2_sent_date != "" && $data[0]->task_2_done == "0")
        {
            $wrong = 0;
        }
        else if($task_number == "3" && $data[0]->task_3_sent_date != "" && $data[0]->task_3_done == "0")
        {
            $wrong = 0;
        }
        else if($task_number == "4" && $data[0]->task_4_sent_date != "" && $data[0]->task_4_done == "0")
        {
            $wrong = 0;
        }
        else if($task_number == "5" && $data[0]->task_5_sent_date != "" && $data[0]->task_5_done == "0")
        {
            $wrong = 0;
        }


        if($wrong == 0)
        {
            $task_name = "task_" . $task_number . "_" . $id . ".php" ;
            $request->task->storeAs('tasks', $task_name);

            $date  = date('Y-m-d');
            
            $update = "UPDATE tasks_degrees SET task_" . $task_number . "_recive_date = '".$date."'  WHERE  id ='".$id."'" ;
            
            DB::statement($update);
            return redirect('/tasks_result');
        }
        else 
            return redirect('/task');
       
        
    }
    private function get_current_task()
    {
        $id = Auth::id();
        $data = tasks_degree::where('id' , $id)->get();

        if(isset($data[0]->task_1_done) && $data[0]->task_1_done  == "0")
        {
            return "1";
            
        }
        else if(isset($data[0]->task_2_done) && $data[0]->task_2_done  == "0")
        {
            return "2";
        }
        else if(isset($data[0]->task_3_done) && $data[0]->task_3_done  == "0")
        {
            return "3";
        }
        else if(isset($data[0]->task_4_done) && $data[0]->task_4_done  == "0")
        {
            return "4";
            
        }
        else if(isset($data[0]->task_5_done) && $data[0]->task_5_done  == "0")
        {
            return "5";
        }
        else
        {
            return "wrong";
        }
    }
}
