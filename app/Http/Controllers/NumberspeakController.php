<?php

namespace App\Http\Controllers;

use App\Models\Numberspeak;
use Illuminate\Http\Request;

class NumberspeakController extends Controller
{
    public function index()
    {
        return response()->json(Numberspeak::all());
    }

    public function show($id)
    {
        return response()->json(Numberspeak::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'percentage' => 'required|string',
        ]);

        return response()->json(Numberspeak::create($request->only('percentage')), 201);
    }

    public function update(Request $request, $id)
    {
        $number = Numberspeak::findOrFail($id);

        $request->validate([
            'percentage' => 'required|string',
        ]);

        $number->update($request->only('percentage'));

        return response()->json($number);
    }

    public function destroy($id)
    {
        Numberspeak::findOrFail($id)->delete();

        return response()->json(['message' => 'Record deleted successfully.']);
    }
}
