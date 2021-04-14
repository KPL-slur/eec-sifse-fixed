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
        return [
            'nama_barang' => 'required|string',
            'group' => 'required|string',
            'part_number' => 'required|string',
            'ref_des' => 'required|string',
            'tgl_masuk' => 'nullable|date',
            'expired' => 'required|date|after_or_equal:tgl_masuk',
            'kurs_beli' => 'nullable|numeric',
            'jumlah_unit' => 'required|integer',
            'status' => 'required|string',
            'keterangan' => 'required'
        ];
    }
}