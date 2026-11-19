<?php

namespace App\Http\Requests\DataDiri;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            'foto'             => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'alamat'           => ['required', 'string'],
            'jenis_kelamin'    => ['required', 'in:L,P'],
            'agama'            => ['required', 'string', 'max:50'],
            'kewarganegaraan'  => ['required', 'string', 'max:50'],
            'status'           => ['required', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'foto.image'                => 'File yang diunggah harus berupa gambar.',
            'foto.mimes'                => 'Format foto harus JPG, JPEG, atau PNG.',
            'foto.max'                  => 'Ukuran foto maksimal adalah 2MB.',
            'jenis_kelamin.in'          => 'Pilihan jenis kelamin tidak valid.',
            'foto.required'             => 'Field :attribute wajib diisi.',
            'alamat.required'           => 'Field :attribute wajib diisi.',
            'jenis_kelamin.required'    => 'Field :attribute wajib diisi.',
            'agama.required'            => 'Field :attribute wajib diisi.',
            'kewarganegaraan.required'  => 'Field :attribute wajib diisi.',
            'status.required'           => 'Field :attribute wajib diisi.',
        ];
    }
}
