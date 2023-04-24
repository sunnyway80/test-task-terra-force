<?php

namespace App\Http\Requests;

    use Illuminate\Contracts\Validation\Rule;
    use Illuminate\Foundation\Http\FormRequest;

    class PostRequest extends FormRequest
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
         * @return array<string, array|Rule|string>
         */
        public function rules(): array
        {
            return [
                'title'       => [
                    'required',
                    'string',
                    'max:255',
                ],
                'description' => [
                    'required',
                    'string',
                ],
                'content'     => [
                    'required',
                    'string',
                ],
            ];
        }
    }
