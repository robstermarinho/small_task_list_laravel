<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests\TaskRequest;
use Auth;
use Response;
use SoapBox\Formatter\Formatter;

class TaskController extends Controller
{
    // Change the state of a given task
    public function change_state(Request $request){
        $result = $request->all();                                  // POST parameters
        $result['status'] = false;                                  // Set status result to false until save the new state
        $task = Task::find($result['task_id']);                     // Find the task with the given id
        $task->state = $result['state_change'];                     // Change its state
        if(Auth::user()->can('change_state-task', $task)){          // Save on database if the user has permission
            $task->save();
            $result['status'] = true;                               // Set status result to true indicatind success saving new state
            $result['updt'] = $task->updated_at->diffForHumans();   // Get formated updated_at date
        }
        return $result;
    }

    // Open a form to edit some task
    public function edit($id){
        $task = Task::find($id);                                    // Get the task
        if($task == null)
            return view('msg_only')->with(['danger' => "This task doesn't exist."]); // If the task Doesn't exist
        return view('tasks.edit_form')->with(['task' => $task]);    // Return task info to a view form
    }

    // Update some task
    public function update(TaskRequest $request){
        $result = $request->only(['id', 'name', 'description']);    // Get the request parameters
        $task = Task::find($result['id']);                          // Find the test with this id
        $task->name = $result['name'];                              // Change the informations
        $task->description = $result['description'];
        $task->save();
        return redirect('/task/edit/' .$result['id'])->withInput(); // Redirecting to the edit page
    }

    // Open a form to add some task
    public function add(){
        return view('tasks.add_form');
    }

    // Create a new task
    public function save(TaskRequest $request){
        $task = $request->all();
        $task['user_id'] = Auth::user()->id;
        Task::create($task);
        return redirect()->action('HomeController@index')
        ->withInput(['name' => $task['name']]);
    }

    // Delete some task
    public function delete($id){
        $task = Task::find($id);
        if($task == null)
            return view('msg_only')->with(['danger' => "This task doesn't exist."]); // If the task Doesn't exist

        if(Auth::user()->can('delete-task', $task)){                // The user can only delete a task according to
            $task->delete();                                        // the police gate 'delete-task' defined in AuthServiceProvider
            return redirect()->action('HomeController@index')->with(['msg' => "Task sucessfully deleted."]);
        }
        return redirect()->action('HomeController@index')->with(['msg' => "You don't have permission to delete this task"]);
    }

    // Generate CVS table
    public function cvs_table(){
        $tasks = Task::all();                                                           // Get all tasks
        $handle = fopen("cvs_table.csv", 'w+');                                         // Open a file
        fputcsv($handle, ['Name', 'Description', 'State', 'Created in','Last Update']); // Put the titles in the first line
        foreach($tasks as $task) {
            fputcsv($handle, [  $task['name'], $task['description'], $task['state'],    // Write the tasks
                                $task['created_at'], $task['updated_at']]);
        }
        fclose($handle);                                                                // Close the file

        return Response::download("cvs_table.csv", 'cvs_table.csv', ['Content-Type' => 'text/csv']); // Export to the browser

    }

    // Generate XML table
    public function xml_table(){
        $formatter = Formatter::make(Task::all(), Formatter::JSON);             //Formarting the task JSON object
        return Response::make($formatter->toXml(), '200')                       //Returnin to XML
        ->header('Content-Type', 'text/xml');
    }
}
