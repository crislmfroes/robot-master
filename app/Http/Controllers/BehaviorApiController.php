<?php

namespace App\Http\Controllers;

use App\Behavior;
use App\Http\Requests\BehaviorApiRequest;
use App\Robot;
use Illuminate\Http\Request;

class BehaviorApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Robot $robot)
    {
        return $robot->behaviors()->collection();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BehaviorApiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Behavior  $behavior
     * @return \Illuminate\Http\Response
     */
    public function show(Behavior $behavior)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Behavior  $behavior
     * @return \Illuminate\Http\Response
     */
    public function update(BehaviorApiRequest $request, Behavior $behavior)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Behavior  $behavior
     * @return \Illuminate\Http\Response
     */
    public function destroy(Behavior $behavior)
    {
        //
    }
}
