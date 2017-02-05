<?php

namespace App\Http\Controllers;

use App\ElectricityReading;
use App\GasInvoice;
use App\GasReading;
use App\Http\Requests\ImportRequest;
use App\User;
use App\WaterReading;
use Exception;
use Storage;
use Zipper;

class BackupController extends Controller
{
    /**
     * Store all four dump files, zip them and return.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function create(User $user)
    {
        try {
            // attempt to save the dump files to the storage
            ElectricityReading::storeDump($user);
            GasInvoice::storeDump($user);
            GasReading::storeDump($user);
            WaterReading::storeDump($user);
        } catch (Exception $e) {
            // something went wrong whilst attempting to save the dump files
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // get the full path to the user's dump directory
        $dumpDirectoryPath = Storage::disk('dump')->getDriver()->getAdapter()->applyPathPrefix($user->id);
        $dumpFilePath = Storage::disk('dump')->getDriver()->getAdapter()->applyPathPrefix($user->id . '.zip');


        // make the zip archive from the dump directory
        Zipper::make($dumpFilePath)->add($dumpDirectoryPath)->close();

        // there was no exception so return the file from storage
        return response()->download($dumpFilePath, null, ['Content-Type' => 'application/zip']);
    }

    /**
     * Restore all four dump files from the uploaded zip archive.
     *
     * @param ImportRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(ImportRequest $request, User $user)
    {
        try {
            // attempt to store the uploaded file
            $request->file('dump')->storeAs('.', $user->id . '.zip', 'dump');

            // get the full path to the user's dump directory
            $dumpDirectoryPath = Storage::disk('dump')->getDriver()->getAdapter()->applyPathPrefix($user->id);
            $dumpFilePath = Storage::disk('dump')->getDriver()->getAdapter()->applyPathPrefix($user->id . '.zip');

            // if file has been uploaded, attempt to uznip it
            Zipper::make($dumpFilePath)->extractTo($dumpDirectoryPath);
            // and restore the data
            ElectricityReading::import($user);
            GasInvoice::import($user);
            GasReading::import($user);
            WaterReading::import($user);
        } catch (Exception $e) {
            // something went wrong whilst attempting to import the dump
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // there was no exception so return the ok response
        return response()->json([], 200);
    }
}
