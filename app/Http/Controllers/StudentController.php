<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with(['handbook', 'registeredSubjects', 'course'])->get();
        return json_encode($students);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student();
        $student->matric_no = $request->get('matric_no');
        $student->name = $request->get('name');
        $student->starting_year = $request->get('starting_year');
        $student->course_code = $request->get('course_code');
        return json_encode($student->save());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($student)
    {
        $student = Student::with(['handbook', 'registeredSubjects', 'course'])->where('matric_no', $student)->get();
        return json_encode($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $student)
    {
        $student = Student::where('matric_no', $student)->get();
        $student->name = $request->get('name');
        $student->starting_year = $request->get('starting_year');
        $student->course_code = $request->get('course_code');
        return json_encode($student->save());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($student)
    {
        $student = Student::where('matric_no', $student)->get();
        return json_encode($student->delete());
    }
}
