<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->check()) {
            $role = auth()->user()->role_as;
            
            if ($role == 0) {
                $courses = Course::all();
            return view('User.Home', compact('courses'));
            } elseif ($role == 1) {
                return view('Admin.index');
            }
        }

        // Handle other cases (e.g., user not authenticated or invalid role)
        return redirect('/'); // Redirect to a default page
    }
}
