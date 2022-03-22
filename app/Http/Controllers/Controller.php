<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    static   public  function isTeacher($method_name,$params=null)
    {
        
        
        if(Auth::check())
        {
            if(auth()->user()->role == 1)
            {

                $class_name = get_called_class();
                $instance = new $class_name();
                return $instance->$method_name($params);
            }
            
            else
            {
                return redirect("/dashboard");
            }

        }
        else
        {
            return redirect("/login");
        }
        

    }
}
