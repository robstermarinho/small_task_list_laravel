<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
use Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();                                                   // Get current user
        $tasks = ($user->role == 'regular' ? $user->tasks : Task::all());       // If he is a regular user get only their tasks
                                                                                // Otherwise get all tasks
        return view('home')->with('tasks', $tasks);                             // Returning tasks to the view
    }
}
