<?php

namespace App\Http\Controllers;

use App\Models\Bestoffer;
use Illuminate\Http\Request;

class BestofferController extends Controller
{
    public function index()
    {
        return Bestoffer::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone_number' => 'required|string|max:20',
            'receipt_country' => 'required|string|max:255',
            'import_country' => 'required|string|max:255',
            'pickup_city' => 'required|string|max:255',
            'number_of_packages' => 'required|integer',
            'gross_weight' => 'required|numeric',
            'type_of_service' => 'required|string',
            'details' => 'nullable|string',
        ]);

        return Bestoffer::create($data);
    }

    public function show($id)
    {
        return Bestoffer::findOrFail($id);
    }

    public function destroy($id)
    {
        $request = Bestoffer::findOrFail($id);
        $request->delete();
        return response()->json(['message' => 'Transport request deleted successfully']);
    }
}
