<?php

namespace App\Business;

use App\Repositories\ZipcodesRepository;

class AgentsMapper
{
    /**
     * Create a new agents mapper instance.
     *
     * @return void
     */
    public function __construct(ZipcodesRepository $zipcodesRepository)
    {
        $this->zipcodesRepository = $zipcodesRepository;
    }

    /**
     * Method that allows to map the input of the zip codes of the agents 
     * to latitude and longitude coordinates to perform the calculations 
     * necessary for the classification by location.
     *
     * @param array $agentsInput Array of agents input of type 'key' => 'value' 
     *              such as (agent{$agentId}_zipcode => {$zipcodeInput})
     * @return array Array of agent ids with its latitude and longitude 
     *               getted of zip code input
     */
    public function mapZipcodesInputToLatLng($agentsInput)
    {
        $agentsLatLng = [];

        foreach ($agentsInput as $agentKey => $zipcodeInput) {
            $zipcode = $this->zipcodesRepository->find($zipcodeInput);

            $agent = [
                'id' => $this->mapAgentKeyToId($agentKey),
                'lat' => $zipcode->lat,
                'lng' => $zipcode->lng,
            ];

            $agentsLatLng[] = $agent;
        }

        return $agentsLatLng;
    }

    /**
     * Method that allows to map the agent input key to agent id.
     *
     * @param string $agentKey Key of agent input
     * @return integer Agent id
     */
    public function mapAgentKeyToId($agentKey)
    {
        return intval(preg_replace('/[^0-9]+/', '', $agentKey));
    }
}
