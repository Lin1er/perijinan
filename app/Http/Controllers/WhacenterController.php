<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWhacenterRequest;
use App\Http\Requests\UpdateWhacenterRequest;
use App\Models\Whacenter;
use Illuminate\Support\Facades\Http;

class WhacenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $whacenters = Whacenter::all();
        return view('admin.whacenter.index', compact('whacenters'));
    }

    public function scanQrCode(Whacenter $whacenter)
    {
        $url = "https://app.whacenter.com/api/qr?device_id="+$whacenter->device_id;
        Http::post($url, [
            'whacenter_id' => $whacenter->id
        ]);
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
    public function store(StoreWhacenterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Whacenter $whacenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Whacenter $whacenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWhacenterRequest $request, Whacenter $whacenter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Whacenter $whacenter)
    {
        //
    }
}
