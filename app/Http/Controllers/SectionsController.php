<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;


class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // getting available rooms  list  
        $user_id = Auth::user()->id;
        $rooms_list = DB::select("select room_id,description from  rooms where user_id='{$user_id}'");
        
        // check if the room is already linked with section so dont show it
        $key = 0;
        foreach($rooms_list as $room)
        {
            if (DB::select("select room_id from  sections where room_id='{$room->room_id}'")!=null)
            {
                unset($rooms_list[$key]);
            }
            $key++;
        }

        //get the  list of section of that user 
        $sections = DB::select("select * from  sections where room_id in (select room_id from rooms where user_id ='{$user_id}')");

        return view('section.index',['rooms_list'=>$rooms_list,'sections'=>$sections,'user'=>Auth::user()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->room_id  == null)
        {
            return redirect('/section');
        }
        $user_id = Auth::user()->id;
        $verify = DB::selectOne("select room_id,user_id from  rooms where user_id={$user_id} and room_id = '{$request->room_id}'");
        // check if the user made the request and the room exist
        if ($verify->room_id == $request->room_id && $verify->user_id == $user_id)
        {
            $section_ver = DB::selectOne("select id from  sections where room_id='{$request->room_id}'");
            
            //if $section == null that means there is no room related to that section 
            // so the room coud be related to desired section
            if($section_ver == null)
            {
                $section = new Section();
                $section->description =  $request->description;
                $section->room_id = $request->room_id;
                $section->user_id =  $user_id;


                // everything is okay ...
                if ($section->save())
                {
                    return redirect('/section');
                }
                else
                {
                     return view('section.alertSection',['message'=>'An error occurred while linking Room to Section!']);
                }

            }
            else
            {
                return view('section.alertSection',['message'=>'The room is already related with a section!']);
            }
        }
        else
        {
            return view('section.alertSection',['message'=>'An error occurred please recheck!']);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section =  Section::where('room_id',$id)->delete();
        return redirect('/section');
    }
}
