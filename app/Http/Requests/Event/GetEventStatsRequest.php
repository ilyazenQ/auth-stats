<?php

namespace App\Http\Requests\Event;

use App\Models\Event;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;



class GetEventStatsRequest extends FormRequest
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
            'name' => ['required', 'string','max:255'],
            'date_to' => ['required','date_format:Y-m-d H:i:s'],
            'date_from' => ['required','date_format:Y-m-d H:i:s'],
            'type' => ['required', Rule::in(Event::AVAILABLE_AGGREAGATION)],
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code' => 422,
            "data" => [
                'message' => 'Validation errors',
                'meta' => $validator->errors()
            ]
        ], 422));
    }
}
