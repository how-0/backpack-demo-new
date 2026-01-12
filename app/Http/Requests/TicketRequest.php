<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => 'required|min:3|max:255',
            'gender'  => 'required|in:Male,Female',
            'inquiry' => 'required|min:10',
            'status'  => 'required|in:New,Processing,Completed,Cancel',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'    => 'Name is required.',
            'gender.required'  => 'Please select gender.',
            'inquiry.required' => 'Inquiry cannot be empty.',
            'status.required'  => 'Status is required.',
        ];
    }
}
