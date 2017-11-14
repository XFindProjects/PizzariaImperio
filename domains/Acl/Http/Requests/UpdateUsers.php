<?php

namespace Acl\Http\Requests;

use App\Support\Repositories\UsersRepository;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUsers extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->route('user');
        return auth()->user()->can('update', $user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|exists:users',
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|integer|between:1,5'
        ];
    }
}
