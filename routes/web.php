<?php
use App\Task;
use Illuminate\Http\Request;

Route::get('/', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();

    return view('tasks.index', [
      'tasks' => $tasks,
    ]);

});

Route::post('/task', function (Request $Request) {

    $validator = Validator::make($Request->all(), [
      'name' => 'required|max:255',
    ]);

      if ($validator->fails()){
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
      }

      Task::create([
        'name' => $Request->name,
      ]);

      return redirect('/');
});

Route::delete('/task/{task}', function (Task $task) {
  $task->delete();
  return redirect('/');
});
