<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LetterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'company_name' => 'required',
            'letter_type' => 'required|in:imported,exported,contract',
            'action_date' => 'required',
            'attached_file' => 'mimes:zip,pdf,doc,docx,xsl,xslx,jpg,jpeg,png,rar|max:15360'
        ];
        if(!env("LETTER_NUMBER_AUTOMATIC"))
            $rules['letter_number'] = 'required|min:3';
        return $rules;
    }
}
