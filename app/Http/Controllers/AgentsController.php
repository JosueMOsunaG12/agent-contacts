<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AgentsRepository;
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
        AgentsRepository $agentsRepository,
        ContactsRepository $contactsRepository,
        AgentsMapper $agentsMapper,
        ContactsTransformer $contactsTransformer
    ) {
        $this->agentsRepository = $agentsRepository;
        $this->contactsRepository = $contactsRepository;
        $this->agentsMapper = $agentsMapper;
        $this->contactsTransformer = $contactsTransformer;
    }

    /**
     * Method that allows show index for agent contacts.
     *
     * @return 
     */
    public function index()
    {
        $agents = $this->agentsRepository->findAll();

        return view('agent-contacts')->with(compact('agents', 'contactsAgent1', 'contactsAgent2'));
    }


    /**
     * Method that allows split the contacts according to agents zip codes.
     *
     * @return Illuminate\Support\Collection of Contacts with Agent Information
     */
    public function splitContacts(AgentsRequest $request)
    {
        $agentsLatLng = $this->agentsMapper->mapZipcodesInputToLatLng($request->except(['_token']));
        $contacts = $this->contactsRepository->findAll();
        $agents = $this->agentsRepository->findAll();
        $contacts = $this->contactsTransformer->transformContactsToSplitByAgents($contacts, $agentsLatLng);
        $contactsAgent1 = $this->contactsTransformer->filterByAgentId($contacts, 1);
        $contactsAgent2 = $this->contactsTransformer->filterByAgentId($contacts, 2);

        return view('agent-contacts')->with(compact('agents', 'contactsAgent1', 'contactsAgent2'));
    }
}
