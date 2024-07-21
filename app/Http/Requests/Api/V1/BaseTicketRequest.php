<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class BaseTicketRequest extends FormRequest
{

    public function mappedAttributes() {
        $attributeMap = [
            'data.attributes.title' => 'title',
            'data.attributes.description' => 'description',
            'data.attributes.status' => 'status',
            'data.attributes.createdAt' => 'created_at',
            'data.attributes.updatedAt' => 'updated_at',

            'data.relationships.author.data.id' => 'user_id'
        ];

        $attributesToUpdates = [];
        foreach ($attributeMap as $key => $attribute){
            if($this->has($key)){
                $attributesToUpdates[$attribute] = $this->input($key); 
            }
        }
        return $attributesToUpdates;
    }

    public function messages() {
        return [
            'data.attributes.status' => 'The data.attributes.status value is invalid. Please use A, C, H, or X.'
        ];
    }
}
