<?php

namespace App\Business;

use App\Repositories\ZipcodesRepository;

class ContactsTransformer
{
    /**
     * Create a new contacts transformer instance.
     *
     * @return void
     */
    public function __construct(
        ZipcodesRepository $zipcodesRepository,
        HarversineCalculator $harversineCalculator
    ) {
        $this->zipcodesRepository = $zipcodesRepository;
        $this->harversineCalculator = $harversineCalculator;
    }

    /**
     * Method that allows transform contacts to structure with split by agents.
     *
     * @param Illuminate\Support\Collection $contacts Collection of contacts
     * @param array $agentsLatLng Array of agents with its latitude and longitude
     * @return Illuminate\Support\Collection Collection of contacts classified by 
     *         nearest agent
     */
    public function transformContactsToSplitByAgents($contacts, $agentsLatLng)
    {
        $contacts->transform(function ($contact, $key) use ($agentsLatLng) {
            $agent = 0;
            $distance = PHP_INT_MAX;
            $zipcode = $this->zipcodesRepository->find($contact->zipcode_id);
            $contact->lat = $zipcode->lat;
            $contact->lng = $zipcode->lng;

            foreach ($agentsLatLng as $agent) {
                $harversineDistance = $this->harversineCalculator->getDistance($agent['lat'], $agent['lng'], $contact->lat, $contact->lng);
                
                if ($harversineDistance < $distance) {
                    $distance = $harversineDistance;
                    $agentId = $agent['id'];
                }
            }

            $contact->agent = $agentId;

            return $contact;
        });

        return $contacts->all();
    }

    /**
     * Method that allows transform contacts to filter by agent
     *
     * @param Illuminate\Support\Collection $contacts Collection of contacts
     * @param integer Agent Id to be filtered
     * @return Illuminate\Support\Collection Collection of contacts filtered by 
     *         Agent Id
     */

    public function filterByAgentId($contacts, $agentId)
    {
        $filteredContacts = collect($contacts)->filter(function ($contact, $key) use ($agentId) {
            return $contact->agent == $agentId;
        });

        return $filteredContacts->all();
    }
}
