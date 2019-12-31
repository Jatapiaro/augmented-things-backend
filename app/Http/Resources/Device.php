<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Type as TypeResource;
use App\Http\Resources\User as UserResource;

class Device extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data['place'] = $this->place->name;
        $data['type'] = new TypeResource($this->type);
        $data['user'] = new UserResource($this->user);
        return $data;
    }
}
