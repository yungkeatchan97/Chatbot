<?php

namespace App\Http\Controllers;

use App\Handbook;
use Illuminate\Http\Request;

class HandbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $handbooks = Handbook::all();
        return json_encode($handbooks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $handbook = new Handbook();
        $handbook->year = $request->get('year');
        $handbook->total_credit_hour = $request->get('total_credit_hour');
        $handbook->course_code = $request->get('course_code');
        return json_encode($handbook->save());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Handbook  $handbook
     * @return \Illuminate\Http\Response
     */
    public function show(Handbook $handbook)
    {
        $handbook = Handbook::findOrFail($handbook);
        return json_encode($handbook);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Handbook  $handbook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $handbook)
    {
        $handbook = Handbook::findOrFail($handbook);
        $handbook->year = $request->get('year');
        $handbook->total_credit_hour = $request->get('total_credit_hour');
        $handbook->course_code = $request->get('course_code');
        return json_encode($handbook->save());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Handbook  $handbook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Handbook $handbook)
    {
        $handbook = Handbook::findOrFail($handbook);
        return json_encode($handbook->delete());
    }

    public function subjects($handbook)
    {
        $handbook = Handbook::findOrFail($handbook);
        return json_encode($handbook->subjects);
    }
}
