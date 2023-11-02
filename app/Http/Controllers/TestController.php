<?php

namespace App\Http\Controllers;

use http\Client\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();

        return response()->json(['data' => $data]);
    }
}
