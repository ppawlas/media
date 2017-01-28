<?php

namespace App\Http\Controllers;

use App\Http\Requests\WaterReadingRequest;
use App\User;
use App\WaterReading;
use Exception;

class WaterReadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return response()->json($user->waterReadings, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WaterReadingRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function store(WaterReadingRequest $request, User $user)
    {
        // grab attributes from the request
        $attributes = $request->all();
        // pass the id of the authenticated user
        $attributes['user_id'] = $user->id;

        try {
            // attempt to create a new water reading with provided attributes
            $waterReading = WaterReading::create($attributes);
        } catch (Exception $e) {
            // something went wrong whilst attempting to create a new water reading
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // all good so return the water reading
        return response()->json($waterReading, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @param WaterReading $waterReading
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, WaterReading $waterReading)
    {
        return response()->json($waterReading, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WaterReadingRequest $request
     * @param User $user
     * @param WaterReading $waterReading
     * @return \Illuminate\Http\Response
     */
    public function update(WaterReadingRequest $request, User $user, WaterReading $waterReading)
    {
        // grab attributes from the request
        $attributes = $request->all();
        // pass the id of the authenticated user
        $attributes['user_id'] = $user->id;

        try {
            // attempt to update water reading with provided attributes
            $waterReading->update($attributes);
        } catch (Exception $e) {
            // something went wrong whilst attempting to update water reading
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // all good so return the updated water reading
        return response()->json($waterReading, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @param WaterReading $waterReading
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, WaterReading $waterReading)
    {
        try {
            // attempt to delete water reading
            $waterReading->delete();
        } catch (Exception $e) {
            // something went wrong whilst attempting to delete water reading
            return response()->json(['error' => $e->getMessage()], 500);
        }
        // there was no exception so return the deleted water reading
        return response()->json($waterReading, 200);
    }
}
