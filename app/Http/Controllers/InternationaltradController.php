<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internationaltrad;
use Illuminate\Support\Facades\Storage;

class InternationaltradController extends Controller
{
    public function index()
    {
        $data = Internationaltrad::all()->map(function ($trad) {
            $trad->image = url('public/storage/' . $trad->image);
            return $trad;
        });

        return response()->json($data);
    }

    public function show($id)
    {
        $trad = Internationaltrad::findOrFail($id);
        $trad->image = url('public/storage/' . $trad->image);

        return response()->json($trad);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'itemone_ar' => 'required|string|max:255',
            'itemone_en' => 'required|string|max:255',
            'answerone_ar' => 'required|string',
            'answerone_en' => 'required|string',
            'itemtwo_ar' => 'required|string|max:255',
            'itemtwo_en' => 'required|string|max:255',
            'answertwo_ar' => 'required|string',
            'answertwo_en' => 'required|string',
        ]);

        $path = $request->file('image')->store('internationaltrads', 'public');

        $trad = Internationaltrad::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'image' => $path,
            'itemone_ar' => $request->itemone_ar,
            'itemone_en' => $request->itemone_en,
            'answerone_ar' => $request->answerone_ar,
            'answerone_en' => $request->answerone_en,
            'itemtwo_ar' => $request->itemtwo_ar,
            'itemtwo_en' => $request->itemtwo_en,
            'answertwo_ar' => $request->answertwo_ar,
            'answertwo_en' => $request->answertwo_en,
        ]);

        return response()->json($trad, 201);
    }

    public function update(Request $request, $id)
    {
        $trad = Internationaltrad::findOrFail($id);

        $request->validate([
            'title_ar' => 'sometimes|string|max:255',
            'title_en' => 'sometimes|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'itemone_ar' => 'sometimes|string|max:255',
            'itemone_en' => 'sometimes|string|max:255',
            'answerone_ar' => 'sometimes|string',
            'answerone_en' => 'sometimes|string',
            'itemtwo_ar' => 'sometimes|string|max:255',
            'itemtwo_en' => 'sometimes|string|max:255',
            'answertwo_ar' => 'sometimes|string',
            'answertwo_en' => 'sometimes|string',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($trad->image);

            $path = $request->file('image')->store('internationaltrads', 'public');
            $trad->image = $path;
        }

        $trad->update($request->only('title_ar', 'title_en', 'itemone_ar', 'itemone_en', 'answerone_ar', 'answerone_en', 'itemtwo_ar', 'itemtwo_en', 'answertwo_ar', 'answertwo_en'));

        return response()->json($trad);
    }

    public function destroy($id)
    {
        $trad = Internationaltrad::findOrFail($id);

        Storage::disk('public')->delete($trad->image);

        $trad->delete();

        return response()->json(['message' => 'Record deleted successfully.']);
    }
}
