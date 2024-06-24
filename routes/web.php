<?php

use App\Http\Requests\TaskRequest;
use \App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        'tasks' => Task::paginate(5)
        //'tasks' => Task::latest()->get() -- gets the latest created row (most recent)
        //'tasks' => Task::latest()->where('completed',true)->get() -- gets the latest created row (most recent)
        //where the column completed is true
    ]);
})->name('tasks.index');

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::view('/tasks/create','create')->name('tasks.create');

Route::get('/tasks/{task}/edit', function(Task $task) {
    return view('edit',[
        'task' => $task // no need to worry about model fetching anymore, will throw 404 if not found
    ]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function(Task $task) {
    return view('show',[
        'task' => $task // -If not found, 4o4 page is shown
    ]);
})->name('tasks.show');

Route::post('/tasks', function(TaskRequest $request){
    // $data = $request->validated();
    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];

    // Laravel autorun insert query because new task
    // $task->save();
    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task'=> $task->id])
    ->with('success','Task added successfully!'); //with is one time flash message

})->name('tasks.store');

Route::put('/tasks/{task}', function(Task $task ,TaskRequest $request){
    // $data = $request->validated();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];

    // Laravel autorun update query because new task
    // $task->save();
    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task'=> $task->id])
    ->with('success','Task updated successfully!'); //with is one time flash message

})->name('tasks.update');

Route::delete('/tasks/{task}', function (Task $task){
    $task->delete();

    return redirect()->route('tasks.index')->with('success','Task deleted successfully');
})->name('tasks.destroy');

Route::put('tasks/{task}/toggle-complete', function(Task $task){
    $task->toggleComplete();

    return redirect()->back()->with('Success','Task Updated Successfully!');
})->name('tasks.toggle-complete');


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
