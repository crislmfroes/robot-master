<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BehaviorResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'className' => $this->className,
            'robot' => new RobotResource($this->robot()),
            'author' => new UserResource($this->author()),
            'containedBehaviors' => BehaviorResource::collection($this->containedBehaviors()),
            'containedStates' => StateResource::collection($this->containedStates()),
            'availableParams' => StateParamsResource::collection($this->availableParams()),
            'transitions' => TransitionResource::collection($this->transitions()),
            'outcomes' => OutcomeResource::collection($this->outcomes())
        ];
    }
}
