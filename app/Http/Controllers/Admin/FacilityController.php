<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use App\Models\Facility;
use Inertia\Inertia;

class FacilityController extends Controller
{
    /**
     * Display a listing of facilities.
     */
    public function index()
    {
        $facilities = Facility::withCount('accommodations')
            ->orderBy('name')
            ->paginate(20);

        return Inertia::render('admin/facilities/index', [
            'facilities' => $facilities,
        ]);
    }

    /**
     * Show the form for creating a new facility.
     */
    public function create()
    {
        return Inertia::render('admin/facilities/create');
    }

    /**
     * Store a newly created facility.
     */
    public function store(StoreFacilityRequest $request)
    {
        $facility = Facility::create($request->validated());

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Facility created successfully.');
    }

    /**
     * Show the form for editing the facility.
     */
    public function edit(Facility $facility)
    {
        return Inertia::render('admin/facilities/edit', [
            'facility' => $facility,
        ]);
    }

    /**
     * Update the specified facility.
     */
    public function update(UpdateFacilityRequest $request, Facility $facility)
    {
        $facility->update($request->validated());

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Facility updated successfully.');
    }

    /**
     * Remove the specified facility.
     */
    public function destroy(Facility $facility)
    {
        $facility->delete();

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Facility deleted successfully.');
    }
}