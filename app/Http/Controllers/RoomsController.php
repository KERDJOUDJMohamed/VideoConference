<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Rooms;
use App\Models\Section;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;


class RoomsController extends Controller
{
    public static $role  =  null ;
    /**
     * Generate Random Id  for the room
     *
     * @param integer $length
     * @return string
     */
    function generateRandomString($length = 9) {

        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        //student
        if($user->role == 0)
        {
            $invited  =  DB::select("select s.description as section_description,s.id as section_id, r.description as room_description  , u.name as teacher_name , i.updated_at as date , r.room_id from users u , invites i ,  rooms  r  , sections s where i.user_id = '{$user->id}' and i.section_id = s.id and s.room_id = r.room_id and r.user_id = u.id");
            return view('rooms.indexStudent',['invited'=>$invited]);

        }
        //teacher
        else
        {
            return view('rooms.indexTeacher',['user'=>$user]);
        }
    }

    /**
     * Create new Room for the user 
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user(); // user 
        $desc  = $request->description; // user new description for the roomm
        
        //fill  the table
        $room = new Rooms();
        $room->room_id = $this->generateRandomString();
        $room->user_id =  $user->id;
        $room->Description = $desc  ;
        $room->save();

        return redirect('/rooms');
    }
    /**
     * handling the logique behind joining a room.
     *
     * @return view
     */
    public function join($room_id,){

        $user = Auth::user();
        return view('rooms.join')->with('room_id',$room_id)->with('user_name',$user->name)->with('user_email',$user->email);

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
        //$room_id = $request->_room_id;
        
        $room =  Rooms::where('room_id',$id)->delete();
        return redirect('/rooms');
    }
    

    /**
     * logic to insering student to a room
     *
     * @return void
     */
    public  function invite(Request $request)
    {
        $user = Auth::user(); // user 

        $room_user = DB::selectOne("select * from  rooms where room_id='{$request->room_id}'");
        $student = DB::selectOne("select * from users where  email='{$request->student_email}'");
        
        // check if the room does not exist
        if($room_user == null)
        {
            return view('rooms.alertInviteRoom',['message'=>'The entered room does not exist!']);
        }
        // check if the user does not  own the room
        elseif($room_user->user_id != $user->id)
        {
            return view('rooms.alertInviteRoom',['message'=>'you do not own the room , check that the room id figures in your room\'s list!']);
        }
        // check if the student doesnot have an account
        elseif($student == NULL )
        {
            return view('rooms.alertInviteRoom',['message'=>'That student does not have an account yet , check the entered  email address  !']);
        }
        //everything is ok , so the student can be entered
        else
        {
            // fill the table 
            

        }
    }

    /**
     * if the logged in is a teacher 
     *
     * @param [string] $method_name : mathod to call in the roomscontroller
     */
    

    public static function sendEmail($email,$username)
    {
        Mail::to($email)->send(new WelcomeMail(['username'=>$username]));
    }
}
