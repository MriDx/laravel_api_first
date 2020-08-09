<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Person;
use App\Http\Resources\v2\PersonResource;
use App\Http\Resources\PersonResourceCollection;

class PersonController extends Controller
{
     /**
    * @param Person $person
    * @return PersonResource
    */
    public function show(Person $person) : PersonResource
    {
        return new PersonResource($person);
    }

    /**
     * @return PersonResourceCollection
     */
    public function index() : PersonResourceCollection
    {
        return new PersonResourceCollection(Person::paginate());
    }

    /**
     * @return Person
     */
    public function store(Request $request)
    {

        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'phone'         => 'required',
            'email'         => 'required'
        ]);

        $person = Person::create($request->all());

        return new PersonResource($person);

    }


    public function update(Person $person, Request $request) : PersonResource
    {
        $person->update($request->all());
        return new PersonResource($person);
    }

    /**
     * @param Person $person
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Person $person)
    {
        $person->delete();
        return response()->json();
    }
}
