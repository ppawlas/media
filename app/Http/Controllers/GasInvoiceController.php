<?php

namespace App\Http\Controllers;

use App\GasInvoice;
use App\Http\Requests\GasInvoiceRequest;
use App\User;
use Exception;

class GasInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return response()->json($user->gasInvoices, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GasInvoiceRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function store(GasInvoiceRequest $request, User $user)
    {
        // grab attributes from the request
        $attributes = $request->all();
        // pass the id of the authenticated user
        $attributes['user_id'] = $user->id;

        try {
            // attempt to create a new gas invoice with provided attributes
            $gasInvoice = GasInvoice::create($attributes);
        } catch (Exception $e) {
            // something went wrong whilst attempting to create a new gas invoice
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // all good so return the gas invoice
        return response()->json($gasInvoice, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @param GasInvoice $gasInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, GasInvoice $gasInvoice)
    {
        return response()->json($gasInvoice, 200);
    }

    /**
     * Update the specified resource in storage.
     *d
     * @param GasInvoiceRequest $request
     * @param User $user
     * @param GasInvoice $gasInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(GasInvoiceRequest $request, User $user, GasInvoice $gasInvoice)
    {
        // grab attributes from the request
        $attributes = $request->all();
        // pass the id of the authenticated user
        $attributes['user_id'] = $user->id;

        try {
            // attempt to update gas invoice with provided attributes
            $gasInvoice->update($attributes);
        } catch (Exception $e) {
            // something went wrong whilst attempting to update gas invoice
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // all good so return the updated gas invoice
        return response()->json($gasInvoice, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @param GasInvoice $gasInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, GasInvoice $gasInvoice)
    {
        try {
            // attempt to delete gas invoice
            $gasInvoice->delete();
        } catch (Exception $e) {
            // something went wrong whilst attempting to delete gas invoice
            return response()->json(['error' => $e->getMessage()], 500);
        }
        // there was no exception so return the deleted gas invoice
        return response()->json($gasInvoice, 200);
    }
}
