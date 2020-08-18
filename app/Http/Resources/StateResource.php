<?php

namespace App\Http\Resources;

use App\Transition;
use Illuminate\Http\Resources\Json\JsonResource;

class StateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'className' => $this->className,
            'availableParams' => StateParamsResource::collection($this->availableParams()),
            'transitions' => TransitionResource::collection($this->transitions()),
            'outcomes' => OutcomeResource::collection($this->outcomes())
        ];
    }
}
