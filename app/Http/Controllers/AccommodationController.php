<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\Facility;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AccommodationController extends Controller
{
    /**
     * Display a listing of accommodations.
     */
    public function index(Request $request)
    {
        $query = Accommodation::query()
            ->with(['facilities', 'roomTypes'])
            ->active();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('address', 'like', '%' . $request->search . '%');
        }

        // Filter by type
        if ($request->has('type') && $request->type && $request->type !== 'all') {
            $query->ofType($request->type);
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price_from', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price) {
            $query->where('price_from', '<=', $request->max_price);
        }

        // Filter by facilities
        if ($request->has('facilities') && is_array($request->facilities) && count($request->facilities) > 0) {
            $query->whereHas('facilities', function ($q) use ($request) {
                $q->whereIn('facilities.id', $request->facilities);
            });
        }

        $accommodations = $query->latest()->paginate(12);
        $facilities = Facility::orderBy('name')->get();

        return Inertia::render('accommodations/index', [
            'accommodations' => $accommodations,
            'facilities' => $facilities,
            'filters' => $request->only(['search', 'type', 'min_price', 'max_price', 'facilities']),
        ]);
    }

    /**
     * Display the specified accommodation.
     */
    public function show(Accommodation $accommodation)
    {
        $accommodation->load(['facilities', 'roomTypes' => function ($query) {
            $query->available();
        }]);

        return Inertia::render('accommodations/show', [
            'accommodation' => $accommodation,
        ]);
    }
}