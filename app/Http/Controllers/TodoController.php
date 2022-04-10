<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class TodoController extends Controller
{
    public function index()
    {
        return View::make('home', [
            'todos' => Todo::query()->orderBy('done', 'asc')->latest()->get(),
            'todo' => Request::get('id') ? Todo::query()->findOrFail(Request::get('id')) : null
        ]);
    }

    public function store()
    {
        Todo::query()->create(Request::validate([
            'things' => 'required'
        ]));

        return Redirect::back();
    }

    public function done(Todo $todo)
    {
        $todo->done = true;
        $todo->save();

        return Redirect::back();
    }

    public function delete(Todo $todo)
    {
        $todo->delete();
        return Redirect::back();
    }

    public function edit(Todo $todo)
    {
        $todo->things = Request::get('things');
        $todo->save();
        return Redirect::route('todos.index');
    }
}
