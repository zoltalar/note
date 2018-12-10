<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'note' => 'required',
            'category_id' => 'required'
        ];
    }
    
    public function attributes()
    {
        return [
            'category_id' => mb_strtolower(__('phrases.category'))
        ];
    }
}