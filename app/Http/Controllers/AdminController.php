<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected AdminService $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function admin()
    {
        return view('admin');
    }

    public function index()
    {
        $users = $this->adminService->getAllUsers();
    }
}
