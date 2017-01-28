<?php

namespace App\Http\Controllers;

use App\ElectricityReading;
use App\Http\Requests\ElectricityReadingRequest;
use App\User;
use Exception;

class ElectricityReadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return response()->json($user->electricityReadings, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ElectricityReadingRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function store(ElectricityReadingRequest $request, User $user)
    {
        // grab attributes from the request
        $attributes = $request->all();
        // pass the id of the authenticated user
        $attributes['user_id'] = $user->id;

        try {
            // attempt to create a new electricity reading with provided attributes
            $electricityReading = ElectricityReading::create($attributes);
        } catch (Exception $e) {
            // something went wrong whilst attempting to create a new electricity reading
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // all good so return the electricity reading
        return response()->json($electricityReading, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @param ElectricityReading $electricityReading
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, ElectricityReading $electricityReading)
    {
        return response()->json($electricityReading, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ElectricityReadingRequest $request
     * @param User $user
     * @param ElectricityReading $electricityReading
     * @return \Illuminate\Http\Response
     */
    public function update(ElectricityReadingRequest $request, User $user, ElectricityReading $electricityReading)
    {
        // grab attributes from the request
        $attributes = $request->all();
        // pass the id of the authenticated user
        $attributes['user_id'] = $user->id;

        try {
            // attempt to update electricity reading with provided attributes
            $electricityReading->update($attributes);
        } catch (Exception $e) {
            // something went wrong whilst attempting to update electricity reading
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // all good so return the updated electricity reading
        return response()->json($electricityReading, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @param ElectricityReading $electricityReading
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, ElectricityReading $electricityReading)
    {
        try {
            // attempt to delete electricity reading
            $electricityReading->delete();
        } catch (Exception $e) {
            // something went wrong whilst attempting to delete electricity reading
            return response()->json(['error' => $e->getMessage()], 500);
        }
        // there was no exception so return the deleted electricity reading
        return response()->json($electricityReading, 200);
    }
}
