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
        /*
         * Three counters are added to control the contact assignment threshold, 
         * the zero position is the general counter, the first counter is what has been
         * assigned for agent 1 and the second counter corresponds to those of agent 2.
         */
        $contactsCount = [
            $contacts->count(),
            0,
            0,
        ];

        $contacts->transform(function ($contact, $key) use ($agentsLatLng, &$contactsCount) {
            $distance = PHP_INT_MAX;
            $zipcode = $this->zipcodesRepository->find($contact->zipcode_id);
            $contact->lat = $zipcode->lat;
            $contact->lng = $zipcode->lng;

            foreach ($agentsLatLng as $agent) {
                if ($agentIdByThreshold = $this->agentIsAssignedByThreshold($contactsCount)) {
                    $agentId = $agentIdByThreshold;
                }

                $harversineDistance = $this->harversineCalculator->getDistance($agent['lat'], $agent['lng'], $contact->lat, $contact->lng);
                
                if ($harversineDistance < $distance) {
                    $distance = $harversineDistance;
                    $agentId = $agent['id'];
                }
            }

            $contactsCount[intval($agentId)]++;
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

    /**
     * Method that allows assign agent because the other agent has exceeded
     * the threshold permitted. Two-thirds of the contacts to be divided
     * were chosen as a threshold
     *
     * @param array $contactsCount Array of contacts counts, general and by agents.
     * @return integer Agent Id
     */
    protected function agentIsAssignedByThreshold($contactsCount)
    {
        if ($contactsCount[1] > (2 * $contactsCount[0] / 3)) {
            return 2;
        }

        if ($contactsCount[2] > (2 * $contactsCount[0] / 3)) {
            return 1;
        }
    }
}
