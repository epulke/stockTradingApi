<?php

namespace App\Http\Requests;

use App\Rules\EnoughFunds;
use Illuminate\Foundation\Http\FormRequest;

class BuyStockRequest extends FormRequest
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
            "amountBuy" => ["required", "integer", "gt:0", new EnoughFunds()]
            // TODO šeit rule nestrādā
        ];
    }
}
