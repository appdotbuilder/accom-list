<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomTypeRequest;
use App\Http\Requests\UpdateRoomTypeRequest;
use App\Models\Accommodation;
use App\Models\RoomType;
use Inertia\Inertia;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of room types for an accommodation.
     */
    public function index(Accommodation $accommodation)
    {
        $accommodation->load('roomTypes');

        return Inertia::render('admin/room-types/index', [
            'accommodation' => $accommodation,
        ]);
    }

    /**
     * Show the form for creating a new room type.
     */
    public function create(Accommodation $accommodation)
    {
        return Inertia::render('admin/room-types/create', [
            'accommodation' => $accommodation,
        ]);
    }

    /**
     * Store a newly created room type.
     */
    public function store(StoreRoomTypeRequest $request, Accommodation $accommodation)
    {
        $roomType = $accommodation->roomTypes()->create($request->validated());

        return redirect()->route('admin.accommodations.room-types.index', $accommodation)
            ->with('success', 'Room type created successfully.');
    }

    /**
     * Show the form for editing the room type.
     */
    public function edit(Accommodation $accommodation, RoomType $roomType)
    {
        return Inertia::render('admin/room-types/edit', [
            'accommodation' => $accommodation,
            'roomType' => $roomType,
        ]);
    }

    /**
     * Update the specified room type.
     */
    public function update(UpdateRoomTypeRequest $request, Accommodation $accommodation, RoomType $roomType)
    {
        $roomType->update($request->validated());

        return redirect()->route('admin.accommodations.room-types.index', $accommodation)
            ->with('success', 'Room type updated successfully.');
    }

    /**
     * Remove the specified room type.
     */
    public function destroy(Accommodation $accommodation, RoomType $roomType)
    {
        $roomType->delete();

        return redirect()->route('admin.accommodations.room-types.index', $accommodation)
            ->with('success', 'Room type deleted successfully.');
    }
}