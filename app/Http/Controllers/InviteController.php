<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Facades\Auth;


class InviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role == 1)
        {
            $user_id  = Auth::user()->id;
            $sections = $this->AvailableSections($user_id);

            foreach($sections as $section)
            {
                $students[]= DB::select("select i.user_id,u.name,u.email from  invites i , users u where i.section_id='{$section->id}' and u.id = i.user_id ");       
                
            }
            if(!isset($students))
                {
                    $students = null;
                }    
                //dd($sections,$students);
            return view('invite.index',['sections'=>$sections,'students'=>$students]);
            
        }
    }

    public function  kickoutStudent($params)
    {
        
        $student_id =  $params['user_id'] ;
        $section_id =  $params['section_id'];
        $user_id =   Auth::user()->id;

        $tmp  =   DB::selectOne("select user_id from sections  where  id='{$section_id}'");

        // the section beongs to teacher or the student want to leave
        //dd($student_id);
        if($tmp->user_id == $user_id  ||  $student_id == $user_id)
        {
            $student =  DB::table('invites')
                            ->where('section_id','=',$section_id)
                            ->where('user_id','=',$student_id)
                            ->delete();
            
            
            if(Auth::user()->role == 1)
            {
                return redirect('/invite');                
            }
            else
            {
                return redirect('/rooms');
            }
        }
        else
        {
            return redirect('/dashboard');
        }

    }

    /**
     * get all sections that an user under a given id created
     *
     */
    public function AvailableSections($user_id)
    {    
        $sections = DB::select("select id,Description from  sections where user_id='{$user_id}'");
        return $sections;
    }
    
    /**
     * check if the email is registred in the database
     *
     */
    public function StudentEmailChecker($email)
    {
        $student = DB::select("select id from users where email='{$email}'");
        return $student ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $sections_id = $request->section_id;
        $student_email = $request->student_email;

        $invited = $this->StudentEmailChecker($student_email);
        
        if($invited ==  null)
        {
            return view('invite.alertInvite',['message'=>'the email does not exist or did not register yet , please re-check later!']);
        }
        
        if($invited[0]->id == Auth::user()->id)
        {
            return view('invite.alertInvite',['message'=>'you can not invite your self because you own it ! ']);        
        }
        
        $owner = DB::selectOne("select user_id from sections where id='{$sections_id}'");

        if($owner->user_id != Auth::user()->id)
        {
            return view('invite.alertInvite',['message'=>'you can not invite to this room because you dont own it !']);
        }

        // if here so everything is okay : (email exist and user own the section )
        
        $invite = new Invite();
        $invite->user_id = $invited[0]->id;
        $invite->section_id = $sections_id ;
        $result = $invite->save();

        if($result)
        {
            return redirect('/invite');

        }
        else
        {
            return view('invite.alertInvite',['message'=>'UNEXPECTED ERROR! please try again!']);
        }
        
    }

    /**
     * return all the id of the sections that given teacher own
     *
     */
    public function SectionOfTeacher($teacher_id)
    {
        $sections = DB::select("select id from sections where user_id='{$teacher_id}'");
    }

    /**
     * return liste of student that belongs to a  given section
     *
     * @return array|null
     */
    public function StudentListe($sections_id)
    {
        $student_liste = DB::select("select user_id from invites where section_id='{$sections_id}'");
        return $student_liste;
        
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
        //
    }
}
