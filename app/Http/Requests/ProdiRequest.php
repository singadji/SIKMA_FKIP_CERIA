<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProdiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "nama_instrument" => "required|string|max:255",
            "deskripsi" => "required|string|max:255",
        ];
    }

    public function messages(): array
    {
        return [
            "required" => "Field :attribute wajib diisi.",
        ];
    }

    public function attributes(): array
    {
        return [
            "nama_instrument" => "Nama Instrument",
            "deskripsi" => "Deskripsi",
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            "nama_instrument" => trim($this->nama_instrument),
            "deskripsi" => trim($this->deskripsi),
        ]);
    }
}
