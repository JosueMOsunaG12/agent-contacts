<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ContactsRepository;
use App\Http\Requests\AgentsRequest;
use App\Business\AgentsMapper;
use App\Business\ContactsTransformer;

class AgentsController extends Controller
{
    /**
     * Create a new agents controller instance.
     *
     * @return void
     */
    public function __construct(
        ContactsRepository $contactsRepository,
        AgentsMapper $agentsMapper,
        ContactsTransformer $contactsTransformer
    ) {
        $this->contactsRepository = $contactsRepository;
        $this->agentsMapper = $agentsMapper;
        $this->contactsTransformer = $contactsTransformer;
    }

    /**
     * Method that allows split the contacts according to agents zip codes.
     *
     * @return Illuminate\Support\Collection of Contacts with Agent Information
     */
    public function splitContacts(AgentsRequest $request)
    {
        $agentsLatLng = $this->agentsMapper->mapZipcodesInputToLatLng($request->all());
        $contacts = $this->contactsRepository->findAll();

        return $this->contactsTransformer->transformContactsToSplitByAgents($contacts, $agentsLatLng);
    }
}
