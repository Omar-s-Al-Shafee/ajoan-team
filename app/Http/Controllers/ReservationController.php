<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Reservation;


class ReservationController extends Controller
{
    public function store(Request $request)
{
    $course = Course::findOrFail($request->input('course_id'));
    
    // Check if there are available slots in the course
    if ($course->Target_group > 0) {
        // Create the reservation
        Reservation::create([
            'user_id' => auth()->user()->id,
            'course_id' => $course->id,
            'name' => $request->input('name'),
            'email' => $request->input('email'), // Add 'email' here
            'phone' => $request->input('phone'), // Add 'phone' here
            // Other reservation fields
        ]);
        
        
        // Decrease the Target_group by one
        $course->decrement('Target_group');
        
        // You may want to add a success message here
    } else {
        // Handle the case when there are no available slots
        // You may want to display an error message
    }

    // Redirect back or to a success page
    return redirect()->back();
}
}
