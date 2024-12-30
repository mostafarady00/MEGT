<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TermController extends Controller
{
    public function index()
    {
        $terms = Term::all()->map(function ($term) {
            $term->image = url('public/storage/' . $term->image);
            return $term;
        });

        return response()->json($terms);
    }

    public function show($id)
    {
        $term = Term::findOrFail($id);
        $term->image = url('public/storage/' . $term->image);

        return response()->json($term);
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
             'title_ar' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_ar' => 'required|string',
             'description_en' => 'required|string',
        ]);

        $path = $request->file('image')->store('terms', 'public');

        $term = Term::create([
            'title_ar' => $request->title_ar,
             'title_en' => $request->title_en,
            'image' => $path,
            'description_ar' => $request->description_ar,
             'description_en' => $request->description_en,
        ]);

        return response()->json($term, 201);
    }


   public function update(Request $request, $id)
{
    $term = Term::findOrFail($id);

    $request->validate([
        'title_en' => 'required|string|max:255',
        'title_ar' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'description_ar' => 'required|string',
        'description_en' => 'required|string',
    ]);

    if ($request->hasFile('image')) {
        if ($term->image) {
            Storage::disk('public')->delete($term->image);
        }

        $path = $request->file('image')->store('terms', 'public');
        $term->image = $path;
    }

    $term->title_en = $request->title_en;
    $term->title_ar = $request->title_ar;
    $term->description_en = $request->description_en;
    $term->description_ar = $request->description_ar;
    $term->save();

    return response()->json([
        'message' => 'Term updated successfully',
        'data' => $term,
    ], 200);
}

    public function destroy($id)
    {
        $term = Term::findOrFail($id);

        // حذف الصورة
        Storage::disk('public')->delete($term->image);

        $term->delete();

        return response()->json(['message' => 'Term deleted successfully.']);
    }
}
