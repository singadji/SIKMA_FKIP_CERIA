<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SurveyQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "instrument_id" => "required|integer",
            "nomor" => "required|integer",
            "pertanyaan" => "required|string|max:255",
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
            "nomor" => "Nomor",
            "pertanyaan" => "Pertanyaan",
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
