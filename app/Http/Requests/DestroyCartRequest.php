<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestroyCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        $cartItem = $this->route('cartItem');
        return $cartItem && $cartItem->user_id === \Illuminate\Support\Facades\Auth::id();
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
