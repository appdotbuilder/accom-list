<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccommodationRequest;
use App\Http\Requests\UpdateAccommodationRequest;
use App\Models\Accommodation;
use App\Models\Facility;
use Inertia\Inertia;

class AccommodationController extends Controller
{
    /**
     * Display a listing of accommodations for admin.
     */
    public function index()
    {
        $accommodations = Accommodation::with(['facilities', 'roomTypes'])
            ->latest()
            ->paginate(10);

        return Inertia::render('admin/accommodations/index', [
            'accommodations' => $accommodations,
        ]);
    }

    /**
     * Show the form for creating a new accommodation.
     */
    public function create()
    {
        $facilities = Facility::orderBy('name')->get();

        return Inertia::render('admin/accommodations/create', [
            'facilities' => $facilities,
        ]);
    }

    /**
     * Store a newly created accommodation.
     */
    public function store(StoreAccommodationRequest $request)
    {
        $accommodation = Accommodation::create($request->validated());

        if ($request->has('facilities')) {
            $accommodation->facilities()->sync($request->facilities);
        }

        return redirect()->route('admin.accommodations.show', $accommodation)
            ->with('success', 'Accommodation created successfully.');
    }

    /**
     * Display the specified accommodation.
     */
    public function show(Accommodation $accommodation)
    {
        $accommodation->load(['facilities', 'roomTypes']);

        return Inertia::render('admin/accommodations/show', [
            'accommodation' => $accommodation,
        ]);
    }

    /**
     * Show the form for editing the accommodation.
     */
    public function edit(Accommodation $accommodation)
    {
        $accommodation->load('facilities');
        $facilities = Facility::orderBy('name')->get();

        return Inertia::render('admin/accommodations/edit', [
            'accommodation' => $accommodation,
            'facilities' => $facilities,
        ]);
    }

    /**
     * Update the specified accommodation.
     */
    public function update(UpdateAccommodationRequest $request, Accommodation $accommodation)
    {
        $accommodation->update($request->validated());

        if ($request->has('facilities')) {
            $accommodation->facilities()->sync($request->facilities);
        }

        return redirect()->route('admin.accommodations.show', $accommodation)
            ->with('success', 'Accommodation updated successfully.');
    }

    /**
     * Remove the specified accommodation.
     */
    public function destroy(Accommodation $accommodation)
    {
        $accommodation->delete();

        return redirect()->route('admin.accommodations.index')
            ->with('success', 'Accommodation deleted successfully.');
    }
}