<?php
namespace App\Library\Response;

use App\Exceptions\LogicException;
use Illuminate\Foundation\Validation\ValidatesRequests as BaseValidatesRequests;
use Illuminate\Http\Request;

/**
 * Class ValidatesRequests
 * @package App\Library\Traits
 */
trait ValidatesRequests
{
    use BaseValidatesRequests;

    /**
     * Throw the failed validation exception.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exception\HttpResponseException
     */
    protected function throwValidationException(Request $request, $validator)
    {

        throw new LogicException(1010001, $this->formatValidationErrors($validator));

    }
}