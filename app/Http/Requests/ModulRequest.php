<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModulRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "nama_modul" => "required|string|max:255",
            "url" => "nullable|string|max:255",
            "role_id" => "nullable|exists:roles,id",
            "icon" => "nullable|string|max:100",
            "par" => "nullable|exists:modul,id",
            "folder" => "nullable|string|max:255",
        ];
    }

    public function messages(): array
    {
        return [
            "required" => "Field :attribute wajib diisi.",
            "role_id.exists" => "Role tidak valid.",
            "par.exists" => "Parent menu tidak valid.",
        ];
    }

    public function attributes(): array
    {
        return [
            "nama_modul" => "Nama Modul",
            "url" => "URL",
            "aktif" => "Aktif",
            "role_id" => "Role",
            "icon" => "Icon",
            "par" => "Parent Menu",
            "slug" => "Slug",
            "folder" => "Folder",
        ];
    }
}
