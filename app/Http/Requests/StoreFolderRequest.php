<?php

namespace App\Http\Requests;

use App\Models\File;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreFolderRequest extends ParentIdBaseRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'name' => [
                'required',
                Rule::unique(File::class, 'name')
                    ->where('created_by', Auth::id())
                    ->where('parent_id', $this->parent_id)
                    ->whereNull('deleted_at')
            ],
            'path' => ['nullable'],
            'mime' => ['nullable'],
            'size' => ['nullable', 'integer'],
        ]);
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Folder ":input" already exists.'
        ];
    }
}
