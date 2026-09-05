<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', \Illuminate\Validation\Rule::unique(User::class)->ignore($this->user()->id)],
            'phone' => ['required', 'string', 'regex:/^(0|\+84)[3|5|7|8|9][0-9]{8}$/', \Illuminate\Validation\Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }
}
