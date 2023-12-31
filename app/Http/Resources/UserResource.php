<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'username'      => $this->username,
            'email'         => $this->email,
            'gender'        => $this->gender == 'male' ? 'Pria' : 'Wanita',
            'phone'         => $this->phone ?? '-',
            'created_at'    => day($this->created_at),
            'adjust'        => [
                'id_user'   => $this->id,
                'status'    => $this->status
            ]
        ];
    }
}
