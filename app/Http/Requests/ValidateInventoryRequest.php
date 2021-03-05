<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateInventoryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'nama_barang' => 'required',
            'group' => 'required',
            'part_number' => 'required',
            'serial_number' => 'required',
            'tgl_masuk' => 'required',
            'expired' => 'required|after:tgl_masuk'
        ];
        return $rules;
    }
}
