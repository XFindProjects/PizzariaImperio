<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 25/11/2017
 * Hora: 23:22:45
 */

namespace Size\Http\Requests;

use Pizzaria\User;
use Illuminate\Foundation\Http\FormRequest;
use Size\Models\Size;

class CreateSizeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create', Size::class);
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
            'price' => 'required|numeric',
            'sizeable_id' => 'required|integer',
            'sizeable_type' => 'required|string'
        ];
    }
}
