<?php

namespace App\Http\Controllers;

use App\Robot;
use Illuminate\Http\Request;
use App\Http\Requests\RobotRequest;
use Illuminate\Support\Facades\Auth;

class RobotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $robots = $user->robots()->getResults()->unique();
        if (!$robots) {
            $robots = [];
        }
        return view('layouts.list', $data=[
            'collection' => $robots,
            'creation_route' => 'create_robot',
            'creation_text' => 'Add Robot',
            'destroy_route' => 'destroy_robot',
            'edit_route' => 'edit_robot',
            'card_view' => 'cards.robot'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.robot', $data=[
            'route_name' => 'store_robot',
            'btn_text' => 'Create Robot'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RobotRequest $request)
    {
        $validated = $request->validated();
        $robot = new Robot();
        $robot->name = $validated['name'];
        $robot->save();
        $user = Auth::user();
        $robot->users()->attach([$user->id]);
        $robot->save();
        return redirect(route('list_robots'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Robot  $robot
     * @return \Illuminate\Http\Response
     */
    public function show(Robot $robot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Robot  $robot
     * @return \Illuminate\Http\Response
     */
    public function edit(Robot $robot)
    {
        return view('forms.robot', $data = [
            'route_name' => 'update_robot',
            'route_args' => [
                'robot' => $robot
            ],
            'btn_text' => 'Save',
            'item' => $robot
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Robot  $robot
     * @return \Illuminate\Http\Response
     */
    public function update(RobotRequest $request, Robot $robot)
    {
        $validated = $request->validated();
        $user = Auth::user();
        if ($user->hasRobot($robot)) {
            $robot->update($validated);
        }
        return redirect(route('list_robots'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Robot  $robot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Robot $robot)
    {
        $user = Auth::user();
        if ($user->hasRobot($robot)) {
            $robot->delete();
        }
        return redirect(route('list_robots'));
    }
}
