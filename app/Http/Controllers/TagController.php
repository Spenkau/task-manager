<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TagController extends Controller
{
    public function index()
    {
        $tasks = [];

        return response()->view('filtered_tasks', ['tasks' => $tasks]);
    }
}
