<?php

namespace App\Http\Requests\Links;

use App\Http\Requests\BaseRequest;

class LinksCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'link' => ['required', 'url:http,https', 'max:255'],
        ];
    }
}
