<?php

namespace App\Http\Controllers;

use App\GasReading;
use App\Http\Requests\GasReadingRequest;
use App\User;
use Exception;

class GasReadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return response()->json($user->gasReadings, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GasReadingRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function store(GasReadingRequest $request, User $user)
    {
        // grab attributes from the request
        $attributes = $request->all();
        // pass the id of the authenticated user
        $attributes['user_id'] = $user->id;

        try {
            // attempt to create a new gas reading with provided attributes
            $gasReading = GasReading::create($attributes);
        } catch (Exception $e) {
            // something went wrong whilst attempting to create a new gas reading
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // all good so return the gas reading
        return response()->json($gasReading, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @param GasReading $gasReading
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, GasReading $gasReading)
    {
        return response()->json($gasReading, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GasReadingRequest $request
     * @param User $user
     * @param GasReading $gasReading
     * @return \Illuminate\Http\Response
     */
    public function update(GasReadingRequest $request, User $user, GasReading $gasReading)
    {
        // grab attributes from the request
        $attributes = $request->all();
        // pass the id of the authenticated user
        $attributes['user_id'] = $user->id;

        try {
            // attempt to update gas reading with provided attributes
            $gasReading->update($attributes);
        } catch (Exception $e) {
            // something went wrong whilst attempting to update gas reading
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // all good so return the updated gas reading
        return response()->json($gasReading, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @param GasReading $gasReading
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, GasReading $gasReading)
    {
        try {
            // attempt to delete gas reading
            $gasReading->delete();
        } catch (Exception $e) {
            // something went wrong whilst attempting to delete gas reading
            return response()->json(['error' => $e->getMessage()], 500);
        }
        // there was no exception so return the deleted gas reading
        return response()->json($gasReading, 200);
    }
}
