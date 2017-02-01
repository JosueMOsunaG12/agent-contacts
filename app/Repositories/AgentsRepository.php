<?php

namespace App\Repositories;

use App\Models\Agent;
use Cache;

class AgentsRepository
{
    /**
     * Method that allows to find all the ids of the agents.
     *
     * @return Array of Agent Ids
     */
    public function findAllIds()
    {
    	// Remember the agent ids query for a week
        return Cache::remember("agent:ids", 10080, function () {
            return Agent::pluck('id');
        });
    }
}
