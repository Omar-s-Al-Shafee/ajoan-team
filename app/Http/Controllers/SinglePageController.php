<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Category;

class SinglePageController extends Controller{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch courses from the database
        $courses = Course::all();
        $categories = Category::pluck('name', 'id');
        
        // Pass the courses and categories variables to the view
        return view('User.Home', compact('courses', 'categories'));
    }
    

    public function show($id)
    {
        $course = Course::findOrFail($id);

        return view('User.singlepage', compact('course'));
    }

}