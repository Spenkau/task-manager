<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Controller as BaseController;
//TODO в ридми ларавеля глянуть
// Simple, fast routing engine.
//Powerful dependency injection container.
//Multiple back-ends for session and cache storage.
//Expressive, intuitive database ORM.
//Database agnostic schema migrations.
//Robust background job processing.
//Real-time event broadcasting.
class TaskController extends Controller
{
    public function show() {
        $tasks = Task::all();
        return view('tasks', compact('tasks'));
    }
}
