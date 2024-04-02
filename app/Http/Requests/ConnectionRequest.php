<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConnectionRequest extends FormRequest
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
        return[];
        /*return
        [
			'number_of_meters' => 'required',
			'location_id' => 'required',
			'connection_date' => 'required',
			'amc_per_connection' => 'required',
			'connection_status' => 'required',
			'admin_name' => 'required',
			'amc_duration' => 'required',
        ];*/
    }
}
