<?php

namespace App\Http\Requests\Api\V1;

use App\Permissions\V1\Abilities;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class BaseUserRequest extends FormRequest
{

    public function mappedAttributes(array $otherAttributes = []) {
        $attributeMap = array_merge([
            'data.attributes.name' => 'name',
            'data.attributes.email' => 'email',
            'data.attributes.isManager' => 'is_manager',
            'data.attributes.password' => 'password',
        ], $otherAttributes);

        $attributesToUpdate = [];
        foreach ($attributeMap as $key => $attribute) {
            if ($this->has($key)) {
                $value = $this->input($key);

                if ($attribute === 'password') {
                    $value = bcrypt($value);
                }

                $attributesToUpdate[$attribute] = $value;
            }
        }

        return $attributesToUpdate;
    }
}
