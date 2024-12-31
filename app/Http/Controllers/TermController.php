<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function index()
    {
        $terms = Term::all();
        return response()->json($terms);
    }

    public function show($id)
    {
        $term = Term::findOrFail($id);
        return response()->json($term);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
        ]);

        $term = Term::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
        ]);

        return response()->json($term, 201);
    }

    public function update(Request $request, $id)
    {
        $term = Term::findOrFail($id);

        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
        ]);

        $term->update($request->only('title_ar', 'title_en', 'description_ar', 'description_en'));

        return response()->json([
            'message' => 'Term updated successfully',
            'data' => $term,
        ], 200);
    }

    public function destroy($id)
    {
        $term = Term::findOrFail($id);
        $term->delete();

        return response()->json(['message' => 'Term deleted successfully.']);
    }
}
