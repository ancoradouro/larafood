<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            "id" => $this->id,
            "identify" => $this->uuid,
            //"tenant_id" => $this->,
            "name" => $this->name,
            "url" => $this->url,
            "description" => $this->description,
            //"created_at" => $this->
            //"updated_at" => $this->2021-06-11 00:47:08"
        ];
    }
}
