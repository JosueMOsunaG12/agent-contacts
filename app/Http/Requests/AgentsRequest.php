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
        $agentIds = app(AgentsRepository::class)->findAll();
        $rules = [];

        $agentIds->map(function ($agent) use (&$rules) {
            $rules["agent{$agent->id}_zipcode"] = 'required|digits:5';
        });

        return $rules;
    }    
}
