<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKurbanPesertaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'kurban_id' => [
                'required',
                Rule::exists('kurbans', 'id')->where('masjid_id', auth()->user()->masjid_id)
            ],
            'kurban_hewan_id' => 'required',
            'total_bayar' => 'nullable',
            'tanggal_bayar' => 'nullable',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->total_bayar != "") {
            $this->merge([
                'total_bayar' => str_replace('.', '', $this->total_bayar),
            ]);
        }
    }
}
