<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PortfolioFilterRequest extends FormRequest
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
        return [
            "position" => [ "required",
                Rule::in([
                "stockSymbol",
                "amount",
                "purchaseValue",
                "currentValue",
                "profitloss",
                "quote"
                ])
        ],
            "type" => [ "required",
                Rule::in(["ascending", "descending"])
            ]
        ];
    }
}