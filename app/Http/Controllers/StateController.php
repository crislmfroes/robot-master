<?php

namespace App\Http\Controllers;

use App\Http\Requests\StateRequest;
use App\InputKey;
use App\Outcome;
use App\OutputKey;
use App\Robot;
use App\State;
use App\StateParam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $states = $user->states()->getResults()->unique();
        return view('layouts.list', [
            'collection' => $states,
            'creation_route' => 'states.create',
            'creation_text' => 'Add State',
            'destroy_route' => 'states.destroy',
            'edit_route' => 'states.edit',
            'card_view' => 'cards.state'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $robots = Auth::user()->robots;
        return view('forms.state', [
            'route_name' => 'states.store',
            'btn_text' => 'Create State',
            'update' => false,
            'robots' => $robots
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateRequest $request)
    {
        $user = Auth::user();
        $validated = $request->validated();
        $state = new State();
        $state->setName($validated['name']);
        $state->description = $validated['description'];
        $state->author()->associate($user);
        $state->robot()->associate(Robot::find($validated['robot']));
        $state->save();
        foreach ($validated['parameter_keys'] as $index => $parameter_key) {
            $parameter_value = $validated['parameter_values'][$index];
            $state_parameter = new StateParam();
            $state_parameter->name = $parameter_key;
            $state_parameter->value = $parameter_value;
            $state_parameter->state()->associate($state);
            $state_parameter->save();
        }
        foreach ($validated['input_keys'] as $input_key) {
            $state_input_key = new InputKey();
            $state_input_key->name = $input_key;
            $state_input_key->value = '';
            $state_input_key->state()->associate($state);
            $state_input_key->save();
        }
        foreach ($validated['output_keys'] as $output_key) {
            $state_output_key = new OutputKey();
            $state_output_key->name = $output_key;
            $state_output_key->value = '';
            $state_output_key->state()->associate($state);
            $state_output_key->save();
        }
        foreach ($validated['outcomes'] as $outcome) {
            $state_outcome = new Outcome();
            $state_outcome->name = $outcome;
            $state_outcome->state()->associate($state);
            $state_outcome->save();
        }
        return redirect(route('states.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $robots = Auth::user()->robots;
        return view('forms.state', [
            'route_name' => 'states.update',
            'route_args' => [
                'state' => $state
            ],
            'update' => true,
            'robots' => $robots,
            'item' => $state,
            'btn_text' => 'Save'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(StateRequest $request, State $state)
    {
        $user = Auth::user();
        if (!$user->hasState($state)) {
            return redirect(route('home'));
        }
        $validated = $request->validated();
        $state->setName($validated['name']);
        $state->description = $validated['description'];
        $state->save();
        foreach ($state->availableParams()->getResults()->unique() as $state_parameter) {
            $found = false;
            foreach ($validated['parameter_keys'] as $index => $parameter_key) {
                if ($state_parameter->name == $parameter_key) {
                    $parameter_value = $validated['parameter_values'][$index];
                    $state_parameter->value = $parameter_value;
                    $state_parameter->save();
                    $found = true;
                }
            }
            if (!$found) {
                $state_parameter->delete();
            }
        }
        foreach ($state->inputKeys()->getResults()->unique() as $state_input_key) {
            $found = false;
            foreach ($validated['input_keys'] as $input_key) {
                if ($state_input_key->name == $input_key) {
                    $found = true;
                }
            }
            if (!$found) {
                $state_input_key->delete();
            }
        }
        foreach ($state->outputKeys()->getResults()->unique() as $state_output_key) {
            $found = false;
            foreach ($validated['output_keys'] as $output_key) {
                if ($state_output_key->name == $output_key) {
                    $found = true;
                }
            }
            if (!$found) {
                $state_input_key->delete();
            }
        }
        foreach ($state->outcomes()->getResults()->unique() as $state_outcome) {
            $found = false;
            foreach ($validated['outcomes'] as $outcome) {
                if ($state_outcome->name == $outcome) {
                    $found = true;
                }
            }
            if (!$found) {
                $state_outcome->delete();
            }
        }
        foreach ($validated['parameter_keys'] as $index => $parameter_key) {
            $state_parameter_key = $state->availableParams()->findOrNew($validated['parameter_keys_idx'][$index]);
            $state_parameter_key->name = $validated['parameter_keys'][$index];
            $state_parameter_key->value = $validated['parameter_values'][$index];
            $state_parameter_key->save();
        }
        foreach ($validated['input_keys'] as $index => $input_key) {
            $state_input_key = $state->inputKeys()->findOrNew($validated['input_keys_idx'][$index]);
            $state_input_key->name = $input_key;
            $state_input_key->save();
        }
        foreach ($validated['output_keys'] as $index => $output_key) {
            $state_output_key = $state->outputKeys()->findOrNew($validated['output_keys_idx'][$index]);
            $state_output_key->name = $output_key;
            $state_output_key->save();
        }
        foreach ($validated['outcomes'] as $index => $outcome) {
            $state_outcome = $state->outcomes()->findOrNew($validated['outcomes_idx'][$index]);
            $state_outcome->name = $outcome;
            $state_outcome->save();
        }
        $state->save();
        return redirect(route('states.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $state->delete();
        return redirect(route('states.index'));
    }
}
