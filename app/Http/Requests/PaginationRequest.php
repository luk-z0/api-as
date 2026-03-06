<?php

namespace App\Http\Requests;

use App\Constants\Pagination;
use Illuminate\Foundation\Http\FormRequest;

class PaginationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'perPage' => 'nullable|integer|max:100',
            'page'    => 'nullable|integer',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'page' => $this->query('current_page', Pagination::DEFAULT_CURRENT_PAGE),
            'perPage'=> $this->query('perPage', Pagination::DEFAULT_PER_PAGE),
        ]);
    }

    public function messages(): array
    {
        return [
            'current_page.integer' => 'The current page must be a number.',
            'per_page.integer'     => 'The per page limit must be a number.',
        ];
    }
}
