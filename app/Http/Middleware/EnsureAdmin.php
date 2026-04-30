<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $role = Auth::user()->getRawOriginal('role');

        if ($role !== 'admin') {
            return match($role) {
                'teacher' => redirect()->route('teacher.index'),
                'student' => redirect()->route('student.index'),
                'waka'    => redirect()->route('waka.index'),
                default   => redirect()->route('login')->with('error', 'Role tidak dikenali.'),
            };
        }

        return $next($request);
    }
}