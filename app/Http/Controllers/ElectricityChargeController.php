<?php

namespace App\Http\Controllers;

use App\ElectricityCharge;
use App\Http\Requests\ElectricityChargeRequest;
use App\User;
use Exception;

class ElectricityChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return response()->json($user->electricityCharges, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ElectricityChargeRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function store(ElectricityChargeRequest $request, User $user)
    {
        // grab attributes from the request
        $attributes = $request->all();
        // pass the id of the authenticated user
        $attributes['user_id'] = $user->id;

        try {
            // attempt to create a new electricity charge with provided attributes
            $electricityCharge = ElectricityCharge::create($attributes);
        } catch (Exception $e) {
            // something went wrong whilst attempting to create a new electricity charge
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // all good so return the electricity charge
        return response()->json($electricityCharge, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @param ElectricityCharge $electricityCharge
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, ElectricityCharge $electricityCharge)
    {
        return response()->json($electricityCharge, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ElectricityChargeRequest $request
     * @param User $user
     * @param ElectricityCharge $electricityCharge
     * @return \Illuminate\Http\Response
     */
    public function update(ElectricityChargeRequest $request, User $user, ElectricityCharge $electricityCharge)
    {
        // grab attributes from the request
        $attributes = $request->all();
        // pass the id of the authenticated user
        $attributes['user_id'] = $user->id;

        try {
            // attempt to update electricity charge with provided attributes
            $electricityCharge->update($attributes);
        } catch (Exception $e) {
            // something went wrong whilst attempting to update electricity charge
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // all good so return the updated electricity charge
        return response()->json($electricityCharge, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @param ElectricityCharge $electricityCharge
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, ElectricityCharge $electricityCharge)
    {
        try {
            // attempt to delete electricity charge
            $electricityCharge->delete();
        } catch (Exception $e) {
            // something went wrong whilst attempting to delete electricity charge
            return response()->json(['error' => $e->getMessage()], 500);
        }
        // there was no exception so return the deleted electricity charge
        return response()->json($electricityCharge, 200);
    }
}
