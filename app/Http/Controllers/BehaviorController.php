<?php

namespace App\Http\Controllers;

use App\Behavior;
use App\Http\Requests\BehaviorRequest;
use App\Http\Resources\RobotResource;
use App\InputKey;
use App\Outcome;
use App\OutputKey;
use App\Robot;
use App\StateParam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BehaviorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Robot $robot)
    {
        $user = Auth::user();
        if ($user->hasRobot($robot)) {
            $behaviors = $robot->behaviors()->getResults()->unique();
            return view('layouts.list', $data = [
                'collection' => $behaviors,
                'creation_route' => 'create_behavior',
                'creation_args' => [
                    'robot' => $robot
                ],
                'creation_text' => 'Add Behavior',
                'destroy_route' => 'destroy_behavior',
                'edit_route' => 'edit_behavior',
                'card_view' => 'cards.behavior'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Robot $robot)
    {
        return view('forms.behavior', [
            'route_name' => 'store_behavior',
            'route_args' => [
                'robot' => $robot
            ],
            'btn_text' => 'Create Behavior'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Robot $robot, BehaviorRequest $request)
    {
        $user = Auth::user();
        if (!$user->hasRobot($robot)) {
            return redirect(route('home'));
        }
        $validated = $request->validated();
        $behavior = new Behavior();
        $behavior->setName($validated['name']);
        $behavior->description = $validated['description'];
        $behavior->author()->associate($user);
        $behavior->robot()->associate($robot);
        $behavior->save();
        foreach ($validated['parameter_keys'] as $index => $parameter_key) {
            $parameter_value = $validated['parameter_values'][$index];
            $behavior_parameter = new StateParam();
            $behavior_parameter->name = $parameter_key;
            $behavior_parameter->value = $parameter_value;
            $behavior_parameter->behavior()->associate($behavior);
            $behavior_parameter->save();
        }
        foreach ($validated['input_keys'] as $input_key) {
            $behavior_input_key = new InputKey();
            $behavior_input_key->name = $input_key;
            $behavior_input_key->value = '';
            $behavior_input_key->behavior()->associate($behavior);
            $behavior_input_key->save();
        }
        foreach ($validated['output_keys'] as $output_key) {
            $behavior_output_key = new OutputKey();
            $behavior_output_key->name = $output_key;
            $behavior_output_key->value = '';
            $behavior_output_key->behavior()->associate($behavior);
            $behavior_output_key->save();
        }
        foreach ($validated['outcomes'] as $outcome) {
            $behavior_outcome = new Outcome();
            $behavior_outcome->name = $outcome;
            $behavior_outcome->behavior()->associate($behavior);
            $behavior_outcome->save();
        }
        return redirect(route('list_behaviors', $parameters = [
            'robot' => $robot
        ]));
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Behavior  $behavior
     * @return \Illuminate\Http\Response
     */
    public function edit(Robot $robot, Behavior $behavior)
    {
        return view('forms.behavior', [
            'route_name' => 'update_behavior',
            'route_args' => [
                'robot' => $robot,
                'behavior' => $behavior
            ],
            'item' => $behavior,
            'btn_text' => 'Save'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Behavior  $behavior
     * @return \Illuminate\Http\Response
     */
    public function update(Robot $robot, BehaviorRequest $request, Behavior $behavior)
    {
        $user = Auth::user();
        if (!$user->hasRobot($robot)) {
            return redirect(route('home'));
        }
        $validated = $request->validated();
        $behavior->setName($validated['name']);
        $behavior->description = $validated['description'];
        $behavior->save();
        foreach ($behavior->availableParams()->getResults()->unique() as $behavior_parameter) {
            $found = false;
            foreach ($validated['parameter_keys'] as $index => $parameter_key) {
                if ($behavior_parameter->name == $parameter_key) {
                    $parameter_value = $validated['parameter_values'][$index];
                    $behavior_parameter->value = $parameter_value;
                    $behavior_parameter->save();
                    $found = true;
                }
            }
            if (!$found) {
                $behavior_parameter->delete();
            }
        }
        foreach ($behavior->inputKeys()->getResults()->unique() as $behavior_input_key) {
            $found = false;
            foreach ($validated['input_keys'] as $input_key) {
                if ($behavior_input_key->name == $input_key) {
                    $found = true;
                }
            }
            if (!$found) {
                $behavior_input_key->delete();
            }
        }
        foreach ($behavior->outputKeys()->getResults()->unique() as $behavior_output_key) {
            $found = false;
            foreach ($validated['output_keys'] as $output_key) {
                if ($behavior_output_key->name == $output_key) {
                    $found = true;
                }
            }
            if (!$found) {
                $behavior_input_key->delete();
            }
        }
        foreach ($behavior->outcomes()->getResults()->unique() as $behavior_outcome) {
            $found = false;
            foreach ($validated['outcomes'] as $outcome) {
                if ($behavior_outcome->name == $outcome) {
                    $found = true;
                }
            }
            if (!$found) {
                $behavior_outcome->delete();
            }
        }
        foreach ($validated['parameter_keys'] as $index => $parameter_key) {
            $behavior_parameter_key = $behavior->availableParams()->findOrNew($validated['parameter_keys_idx'][$index]);
            $behavior_parameter_key->name = $validated['parameter_keys'][$index];
            $behavior_parameter_key->value = $validated['parameter_values'][$index];
            $behavior_parameter_key->save();
        }
        foreach ($validated['input_keys'] as $index => $input_key) {
            $behavior_input_key = $behavior->inputKeys()->findOrNew($validated['input_keys_idx'][$index]);
            $behavior_input_key->name = $input_key;
            $behavior_input_key->save();
        }
        foreach ($validated['output_keys'] as $index => $output_key) {
            $behavior_output_key = $behavior->outputKeys()->findOrNew($validated['output_keys_idx'][$index]);
            $behavior_output_key->name = $output_key;
            $behavior_output_key->save();
        }
        foreach ($validated['outcomes'] as $index => $outcome) {
            $behavior_outcome = $behavior->outcomes()->findOrNew($validated['outcomes_idx'][$index]);
            $behavior_outcome->name = $outcome;
            $behavior_outcome->save();
        }
        $behavior->save();
        return redirect(route('list_behaviors', $parameters = [
            'robot' => $robot
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Behavior  $behavior
     * @return \Illuminate\Http\Response
     */
    public function destroy(Robot $robot, Behavior $behavior)
    {
        $behavior->delete();
        return redirect(route('list_behaviors', $robot));
    }
}
