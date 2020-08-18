<?php

namespace App\Http\Requests;

use App\Behavior;
use App\Robot;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NoWhitespaces;

class BehaviorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /*$robot = Robot::find($this->route('robot'));
        if ($robot) {
            return $this->user()->can('update', $robot);
        } else {
            return true;
        }*/
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validation_rules = [
            'name' => 'required|max:255',
            'description' => 'required|min:10'
        ];
        foreach($this->get('input_keys') as $key => $value) {
            $validation_rules['input_keys.'.$key] = [
                'required',
                new NoWhitespaces
            ];
        }
        foreach($this->get('input_keys_idx') as $key => $value) {
            $validation_rules['input_keys_idx.'.$key] = 'numeric|integer|nullable';
        }
        foreach($this->get('output_keys') as $key => $value) {
            $validation_rules['output_keys.'.$key] =
            [
                'required',
                new NoWhitespaces
            ];
        }
        foreach ($this->get('output_keys_idx') as $key => $value) {
            $validation_rules['output_keys_idx.' . $key] = 'numeric|integer|nullable';
        }
        foreach($this->get('outcomes') as $key => $value) {
            $validation_rules['outcomes.'.$key] =
            [
                'required',
                new NoWhitespaces
            ];
        }
        foreach ($this->get('outcomes_idx') as $key => $value) {
            $validation_rules['outcomes_idx.' . $key] = 'numeric|integer|nullable';
        }
        foreach($this->get('parameter_keys') as $key => $value) {
            $validation_rules['parameter_keys.'.$key] =
            [
                'required',
                new NoWhitespaces
            ];
        }
        foreach($this->get('parameter_values') as $key => $value) {
            $validation_rules['parameter_values.'.$key] =
            [
                'required',
                new NoWhitespaces
            ];
        }
        foreach ($this->get('parameter_keys_idx') as $key => $value) {
            $validation_rules['parameter_keys_idx.' . $key] = 'numeric|integer|nullable';
        }
        return $validation_rules;
    }
}
