<?php
namespace App\Library\Validators;

use App\Exceptions\LogicException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class JsonValidator extends FormRequest
{

    /**
     * Authorize.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    protected function failedValidation(Validator $validator)
    {
        throw new LogicException(1010001, $this->formatErrors($validator));
    }
}