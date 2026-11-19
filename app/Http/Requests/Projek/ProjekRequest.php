<?php

namespace App\Http\Requests\Projek;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProjekRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_projek' => 'required|string|max:255',
            'kategori'    => 'required|in:Web App,Mobile App,UI/UX Design,Other',
            'peran'       => 'nullable|string|max:255',
            'teknologi'   => 'nullable|string|max:255',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi'   => 'nullable|string',
            'link'        => 'nullable|url|max:255',
            'github_link' => 'nullable|url|max:255',
            'is_featured' => 'nullable|boolean',
        ];
    }

    /**
     * (Opsional) Pesan error kustom dalam bahasa Indonesia.
     */
    public function messages(): array
    {
        return [
            'nama_projek.required' => 'Nama projek wajib diisi.',
            'kategori.required'    => 'Kategori projek wajib dipilih.',
            'kategori.in'          => 'Kategori yang dipilih tidak valid.',
            'logo.image'           => 'File yang diunggah harus berupa gambar.',
            'logo.mimes'           => 'Format logo harus JPG, JPEG, PNG, atau WEBP.',
            'logo.max'             => 'Ukuran logo maksimal 2MB.',
            'link.url'             => 'Format link live demo tidak valid (harus diawali http:// atau https://).',
            'github_link.url'      => 'Format link GitHub tidak valid (harus diawali http:// atau https://).',
        ];
    }
}
