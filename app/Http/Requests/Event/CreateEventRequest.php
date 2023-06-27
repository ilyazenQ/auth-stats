<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;


class CreateEventRequest extends FormRequest
{

    public function __construct(Request $request)
    {
        $request->merge(['ip' => $request->ip()]);
    }
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
            'is_auth' => ['required', 'boolean'],
            'ip' => ['required','ip'],
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
