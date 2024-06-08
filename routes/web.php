<?php

use \App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/tasks', function (){
    return view('index', [
        'tasks' => Task::all()
        //'tasks' => Task::latest()->get() -- gets the latest created row (most recent)
        //'tasks' => Task::latest()->where('completed',true)->get() -- gets the latest created row (most recent)
        //where the column completed is true
    ]);
})->name('tasks.index');

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::view('/tasks/create','create');

Route::get('/tasks/{id}', function($id) {
    return view('show',[
        'task' => Task::findOrFail($id) // -If not found, 4o4 page is shown
    ]);
})->name('tasks.show');

Route::post('/tasks', function(Request $request){
    $data = $request->validate([
        'title' => 'required|max:255',
        'description'=> 'required',
        'long_description' => 'required'
    ]);

    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    // Laravel autorun insert query because new task
    $task->save();

    return redirect()->route('tasks.show', ['id'=> $task->id]);
})->name('tasks.store');


// Route::get('/tasks/{id}', function($id) use($tasks){
//     return view('show',[
//         'task' => \App\Models\Task::findOrFail($id)
//     ]);
// })->name('tasks.show');

// Route::get('/hello',function() {
//     return 'Hello';
// })->name('hello');

// Route::get('/hallo',function() {
//     return redirect()->route('hello');
// });

// Route::get('/greet/{name}',function($name){
//     return "Hello ". $name. "!";
// });

// // For non-existing urls - default route
// Route::fallback(function(){
//     return 'Still got somewhere!';
// });
