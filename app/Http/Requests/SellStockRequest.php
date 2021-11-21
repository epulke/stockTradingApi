<?php

namespace App\Http\Requests;

use App\Rules\EnoughStocksToSell;
use App\Rules\ValidTime;
use Illuminate\Foundation\Http\FormRequest;

class SellStockRequest extends FormRequest
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
            "amountSell" => ["required", "integer", "gt:0", new EnoughStocksToSell(), new ValidTime()]
        ];
    }
}
