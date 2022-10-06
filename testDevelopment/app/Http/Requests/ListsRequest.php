<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'about_companyName' => ['required', 'string', 'max:255'],
            'about_companyName_kana' => ['required', 'string', 'max:255'],
            'about_address' => ['required', 'string', 'max:255'],
            'about_phoneNumber' => ['required', 'string', 'max:255'],
            'about_name' => ['required', 'string', 'max:255'],
            'about_name_kana' => ['required', 'string', 'max:255'],
            'claim_billingName' => ['required', 'string', 'max:255'],
            'claim_billingName_kana' => ['required', 'string', 'max:255'],
            'claim_address' => ['required', 'string', 'max:255'],
            'claim_phoneNumber' => ['required', 'string', 'max:255'],
            'claim_department' => ['required', 'string', 'max:255'],
            'claim_name' => ['required', 'string', 'max:255'],
            'claim_name_kana' => ['required', 'string', 'max:255']
        ];
    }
}
