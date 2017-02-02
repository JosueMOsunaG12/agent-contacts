<?php

namespace App\Repositories;

use App\Models\Agent;
use Cache;

class AgentsRepository
{
    /**
     * Method that allows to find all the agents.
     *
     * @return Illuminate\Support\Collection of agents
     */
    public function findAll()
    {
        // Remember the agents query for a week
        return Cache::remember('agents', 10080, function () {
            return Agent::all();
        });
    }
}
