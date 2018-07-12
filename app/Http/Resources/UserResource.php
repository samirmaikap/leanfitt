<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use function ucfirst;
use function urlencode;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);

        return [
            'id' => $this->id,
            'avatar' => "https://ui-avatars.com/api/?name=" . urlencode(ucfirst($this->first_name) . '. ' . ucfirst($this->last_name)),
            'full_name' => ucfirst($this->first_name) . '. ' . ucfirst($this->last_name),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'organizations' => OrganizationResource::collection($this->whenLoaded('organizations')),
            'departments' =>  $this->departments()->pluck('name'),
//            'roles' =>  $this->departments()->pluck('name'),
            'created_at' => $this->created_at->format('m/d/Y h:i A'),
            'updated_at' => $this->updated_at->format('m/d/Y h:i A'),
        ];
    }
}
