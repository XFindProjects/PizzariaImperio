<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 5/12/2017
 * Hora: 5:33:29
 */

namespace Pizza\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Pizza\Models\Pizza;

class CreatePizzaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create', Pizza::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'flavor' => 'required|string|max:150',
            'image' => 'required|image',
            'description' => 'required|string'
        ];
    }
}
