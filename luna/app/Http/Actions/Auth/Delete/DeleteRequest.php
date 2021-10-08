<?php

declare(strict_types=1);

namespace App\Http\Actions\Auth\Delete;

use Illuminate\Foundation\Http\FormRequest;
use Packages\Services\TokenManagerServiceInterface;

class DeleteRequest extends FormRequest
{
    public function __construct(
        private TokenManagerServiceInterface $tokenManagerService
    ){
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $token = $this->header('Authorization');
        return $this->tokenManagerService->verify($token);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
