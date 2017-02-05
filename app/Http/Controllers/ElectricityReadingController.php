<?php

namespace App\Http\Controllers;

use App\ElectricityCharge;
use App\ElectricityReading;
use App\Http\Requests\ElectricityChargeRequest;
use App\Http\Requests\ElectricityReadingRequest;
use App\Http\Requests\ElectricityUsagePredictionRequest;
use App\Http\Requests\ImportRequest;
use App\User;
use Exception;
use Storage;

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

    /**
     * Restore electricity readings.
     *
     * @param ImportRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(ImportRequest $request, User $user)
    {
        try {
            // attempt to store the uploaded file
            $request->file('dump')->storeAs($user->id, 'electricity-readings.csv', 'dump');
            // if file has been uploaded, attempt to restore the data
            ElectricityReading::import($user);
        } catch (Exception $e) {
            // something went wrong whilst attempting to import the dump
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // there was no exception so return the ok response
        return response()->json([], 200);
    }

    /**
     * Dump electricity readings.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function dump(User $user)
    {
        try {
            // attempt to save the electricity readings dump to the storage
            ElectricityReading::storeDump($user);
        } catch (Exception $e) {
            // something went wrong whilst attempting to save the electricity readings dump
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // get the full path to the dump file
        $path = Storage::disk('dump')->getDriver()->getAdapter()->applyPathPrefix(ElectricityReading::getDumpPath($user));
        // there was no exception so return the file from storage
        return response()->download($path, null, ['Content-Type' => 'text/csv']);
    }

    /**
     * Get the charge.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function getCharge(User $user)
    {
        return response()->json(ElectricityCharge::get($user), 200);
    }

    /**
     * Set the charge.
     *
     * @param ElectricityChargeRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function setCharge(ElectricityChargeRequest $request, User $user)
    {
        // grab attributes from the request
        $attributes = $request->all();
        // pass the id of the authenticated user
        $attributes['user_id'] = $user->id;

        // try to get user's electricity charge
        $electricityCharge = $user->electricityCharge;

        try {
            // if user has electricity charge defined, attempt to update it with provided attributes, otherwise create
            if ($electricityCharge === null) {
                $electricityCharge = ElectricityCharge::create($attributes);
            } else {
                $electricityCharge->update($attributes);
            }
        } catch (Exception $e) {
            // something went wrong whilst attempting to set electricity charge
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // all good so return the set electricity charge
        return response()->json($electricityCharge, 200);
    }

    /**
     * Get the yearly usage and cost and two months cost prediction.
     *
     * @param ElectricityUsagePredictionRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPrediction(ElectricityUsagePredictionRequest $request, User $user)
    {
        return response()->json(ElectricityReading::getPrediction($user, $request->get('initial_date')), 200);
    }
}
