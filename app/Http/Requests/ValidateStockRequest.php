<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateStockRequest extends FormRequest
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
            'site_id' => ['required'],
            'nama_barang' => ['required'],
            'group' => ['required'],
            'part_number' => ['required'],
            'serial_number' => ['required'],
            'tgl_masuk' => ['required'],
            'expired' => ['required'],
            'kurs_beli' => ['required'],
            'jumlah_unit' => ['required'],
            'status' => ['required']
        ];
        return $rules;
    }
}
