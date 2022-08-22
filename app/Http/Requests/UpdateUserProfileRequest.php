<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!Auth::check()) {
            return false;
        }

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
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'biography' => ['required', 'string'],
            'skill' => ['required', 'min:5', 'max:10'],
            'profile_picture' => ['required', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'academy' => ['required', 'max:1'],
        ];
    }
}
