<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::with(['students', 'handbooks'])->get();
        return json_encode($subjects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = new Subject();
        $subject->code = $request->get('code');
        $subject->name = $request->get('name');
        $subject->credit_hour = $request->get('credit_hour');
        return json_encode($subject->save());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        $subject = Subject::with(['students', 'handbooks'])->findOrFail($subject);
        return json_encode($subject);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $subject = Subject::findOrFail($subject);
        $subject->code = $request->get('code');
        $subject->name = $request->get('name');
        $subject->credit_hour = $request->get('credit_hour');
        return json_encode($subject->save());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject = Subject::findOrFail($subject);
        return json_encode($subject->delete());
    }
}
