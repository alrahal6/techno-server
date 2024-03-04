<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Max_currentRequest extends FormRequest
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
        return
        [
			'meter_id' => 'required',
			'channel' => 'required',
			'mx_current' => 'required',
        ];
    }
}
