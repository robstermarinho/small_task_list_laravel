<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    // Get a list of all users of the system
    public function list_all(){
        if(Auth::user()->role == "admin")
            return view('users.list')->with(['users' => User::all()]);
        else
            return view('users.list')->with(['msg' => "Your user don't have permission to access the list of users."]);

    }

    // Open a form to edit some user
    public function edit($id){
        $user = User::find($id);                                      // Get the user
        return view('users.edit_form')->with(['user' => $user]);      // Return user info to a view form
    }

    // Update some user
    public function update(UserRequest $request){
        $result = $request->only(['id', 'first_name','last_name', 'email','role']);
        $user = User::find($result['id']);
        $user->first_name = $result['first_name'];
        $user->last_name = $result['last_name'];
        $user->email = $result['email'];
        $user->role = $result['role'];
        $user->save();
        return redirect('/users/edit/' .$result['id'])->withInput(); // Redirecting to the edit page
    }

    // Delete some user
    public function delete($id){
        $user = User::find($id);
        if(Auth::user()->role == "admin" && Auth::user() != $user){
            foreach($user->tasks as $task)                              // Delete all tasks of this user
                $task->delete();
            $user->delete();                                            // After delete user
            $msg = "User sucessfully deleted.";
        }else{
            $msg = "You can't delete this user.";
        }
        return redirect()->action('UsersController@list_all')->with(['msg' => $msg]);
    }


}
