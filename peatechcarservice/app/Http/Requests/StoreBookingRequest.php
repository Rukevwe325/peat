<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'           => 'required|string|max:255',
            'email'          => 'required|email',
            'service'        => 'required|string',
            'service_date'   => 'required|date',
            'car_model'      => 'required|string',
            'car_photo'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'special_request'=> 'nullable|string'
        ];
    }
}
