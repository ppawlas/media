<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Http\Requests\WaterReadingRequest;
use App\User;
use App\WaterReading;
use Exception;
use Storage;

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

    /**
     * Restore water readings.
     *
     * @param ImportRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(ImportRequest $request, User $user)
    {
        try {
            // attempt to store the uploaded file
            $request->file('dump')->storeAs($user->id, 'water-readings.csv', 'dump');
            // if file has been uploaded, attempt to restore the data
            WaterReading::import($user);
        } catch (Exception $e) {
            // something went wrong whilst attempting to import the dump
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // there was no exception so return the ok response
        return response()->json([], 200);
    }

    /**
     * Dump water readings.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function dump(User $user)
    {
        try {
            // attempt to save the water readings dump to the storage
            WaterReading::storeDump($user);
        } catch (Exception $e) {
            // something went wrong whilst attempting to save the water readings dump
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // get the full path to the dump file
        $path = Storage::disk('dump')->getDriver()->getAdapter()->applyPathPrefix(WaterReading::getDumpPath($user));
        // there was no exception so return the file from storage
        return response()->download($path, null, ['Content-Type' => 'text/csv']);
    }
}
