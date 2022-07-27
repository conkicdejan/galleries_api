<?php

namespace App\Http\Requests;

use App\Rules\ContainForbiddenWord;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'gallery_id' => 'required|exists:galleries,id',
            'content' => ['required','string','max:1000', new ContainForbiddenWord()],
        ];
    }
}
