<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\SectionsController;
use App\Models\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::get('/rooms/{id}', function ($id) {

    //if user is not logged in redirect to login page

    if (Auth::guest()) {
        
        return redirect('login');

       }
    
    // else rendering the view
    else
    {
        return (new RoomsController)->join($room_id = $id);
       // return view('rooms.join',['room_id' => $id]);
    }
})->name('rooms.join');

Route::delete('/rooms.destroy/{id}',function($id){
    return ( new RoomsController)->destroy($id);
})->name('rooms.destroy');

//Route::resource('rooms',RoomsController::class);
Route::get('/rooms',function(){

    return (new RoomsController)->index();
})->name('rooms.index');

Route::post('/rooms',[RoomsController::class,'create'])->name('rooms.create');
Route::post('/invite',[InviteController::class,'create'])->name('invite.create');

Route::post('/section',[SectionsController::class,'create'])->name('section.create');

Route::delete('/sections.destroy/{id}',function($id){
    return SectionsController::isTeacher("destroy",$id);
    //return ( new SectionsController)->destroy($id);
})->name('sections.destroy');

Route::delete('/invite.kickoutStudent/{user_id}/{section_id}',function($user_id,$section_id){

    return (new InviteController)->kickoutStudent(['user_id'=>$user_id,'section_id'=>$section_id]);
   // return InviteController::isTeacher("kickoutStudent",['user_id'=>$user_id,'section_id'=>$section_id]);
    //return ( new SectionsController)->destroy($id);
})->name('invite.kickoutStudent');


Route::get('/invite',function(){

    return InviteController::isTeacher('index');

})->name('invite.index');

Route::get('/section',function(){
    
    return (SectionsController::isTeacher("index"));

})->name('section.index');
