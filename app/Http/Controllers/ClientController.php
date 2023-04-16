<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Throwable;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Client::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $client = new Client;
            $client->name = $request->name;
            $client->last_name = $request->last_name;
            $client->cpf = $request->cpf;
            $client->save();
            return 'succcess';
        } catch(Throwable $e) {
            return $e;
        }   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Client::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return Client::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $client = Client::find($id);
            $client->name = $request->name;
            $client->last_name = $request->last_name;
            $client->cpf = $request->cpf;
            $client->save();
            return 'succcess';
        } catch(Throwable $e) {
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            Client::destroy($id);
            return 'succcess';
        } catch(Throwable $e) {
            return $e;
        }   
    }
}
