<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $hiddenElements = $this->getHidden();
        return [
            'id' => $this->when(!in_array('id',$hiddenElements),
                $this->id),
            'login' => $this->when(!in_array('login',$hiddenElements),
                $this->login),
            'name'=> $this->name,
            'surname' => $this->surname,
        ];
    }
}
