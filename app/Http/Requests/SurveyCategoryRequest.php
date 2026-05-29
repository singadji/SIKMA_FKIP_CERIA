<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SurveyCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "instrument_id" => "required|integer",
            "nama_kategori" => "required|string|max:255",
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
            "instrument_id" => "ID Instrument",
            "nama_kategori" => "Nama Kategori",
            "deskripsi" => "Deskripsi",
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            "instrument_id" => trim($this->instrument_id),
            "nama_kategori" => trim($this->nama_kategori),
            "deskripsi" => trim($this->deskripsi),
        ]);
    }
}
