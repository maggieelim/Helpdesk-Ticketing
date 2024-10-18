<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\employee;
use App\Models\PO;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        return view('pages.dashboard', compact('user'));
    }
    public function countEmployees()
    {
        $totalEmployees = Employee::count();
        $user = Auth::user();
        return view('pages.dashboard', compact('totalEmployees', 'user'));
    }
}
