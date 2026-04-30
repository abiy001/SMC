<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\ReportLeason;

class DashboardController extends Controller
{
   public function index()
    {
        $totalUsers    = User::whereIn('role', ['teacher', 'student', 'waka'])->count();
        $totalClasses  = Classes::count();
        $totalSubjects = Subject::count();
        $totalReports  = ReportLeason::count();

        return view('admin.pages.dashboard', compact(
            'totalUsers',
            'totalClasses',
            'totalSubjects',
            'totalReports',
        ));
    }
}
