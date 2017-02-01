<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\AgentsRepository;

class AgentsRequest extends FormRequest
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
        $agentIds = app(AgentsRepository::class)->findAllIds();
        $rules = [];

        $agentIds->map(function ($agentId) use (&$rules) {
            $rules["agent{$agentId}_zipcode"] = 'required|digits:5';
        });

        return $rules;
    }    
}
