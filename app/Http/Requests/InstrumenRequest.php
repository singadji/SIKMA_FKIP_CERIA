<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InstrumenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "kode" => "required|string|max:255",
            "nama_instrumen" => "required|string|max:255",
            "deskripsi" => "required|string|max:255",
            "is_active" => "required|boolean",
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
            "kode" => "Kode Instrument",
            "nama_instrumen" => "Nama Instrument",
            "deskripsi" => "Deskripsi",
            "is_active" => "Status Aktif",
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            "kode" => trim($this->kode),
            "nama_instrumen" => trim($this->nama_instrumen),
            "deskripsi" => trim($this->deskripsi),
            "is_active" => $this->is_active ?? false,
        ]);
    }
}
