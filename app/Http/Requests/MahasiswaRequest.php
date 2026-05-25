<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MahasiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "nama" => "required|string|max:255",
            "prodi_id" => "required|exists:prodi,id",
            "nim" => "required|string|max:12",
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
            "nama" => "Nama Mahasiswa",
            "prodi_id" => "Prodi",
            "nim" => "NIM",
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            "nama" => trim($this->nama),
        ]);
    }
}
