<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RobotResource extends JsonResource
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
            'users'=> UserResource::collection($this->users()),
            'behaviors' => BehaviorResource::collection($this->behaviors())
        ];
    }
}
