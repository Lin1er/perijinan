<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWhacenterRequest;
use App\Http\Requests\UpdateWhacenterRequest;
use App\Models\Whacenter;
use Illuminate\Http\Request;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.whacenter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWhacenterRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'device_id' => 'required',
        ]);
        Whacenter::create([
            'name' => $request->name,
            'device_id' => $request->device_id,
            'default' => 0
        ]);
        return redirect()->route('admin.whacenter.index');
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
        return view('admin.whacenter.edit', compact('whacenter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWhacenterRequest $request, Whacenter $whacenter)
    {
    $validatedData = $request->validate([
        'name' => 'required',
        'device_id' => 'required',
        'default' => 'required',
    ]);

    $whacenter->update($validatedData);

    return redirect()->route('admin.whacenter.index')
                     ->with('success', 'Whacenter updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Whacenter $whacenter)
    {
    $whacenter->delete();

    return redirect()->route('admin.whacenter.index')
                     ->with('success', 'Whacenter deleted successfully.');
    }
}
