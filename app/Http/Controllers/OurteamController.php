<?php

namespace App\Http\Controllers;

use App\Models\Ourteam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OurteamController extends Controller
{
  public function index()
    {
        $teams = Ourteam::all()->map(function ($team) {
            $team->image = url('public/storage/' . $team->image);
            return $team;
        });

        return response()->json($teams);
    }

    public function show($id)
    {
        $team = Ourteam::findOrFail($id);
        $team->image = url('public/storage/' . $team->image);

        return response()->json($team);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'position_en' => 'required|string|max:255',
            'position_ar' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image')->store('ourteams', 'public');

        $team = Ourteam::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'position_en' => $request->position_en,
            'position_ar' => $request->position_ar,
            'image' => $path,
        ]);

        return response()->json($team, 201);
    }

    public function update(Request $request, $id)
    {
        $team = Ourteam::findOrFail($id);

        $request->validate([
            'name_en' => 'sometimes|string|max:255',
            'name_ar' => 'sometimes|string|max:255',
            'position_en' => 'sometimes|string|max:255',
            'position_ar' => 'sometimes|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($team->image);

            $path = $request->file('image')->store('ourteams', 'public');
            $team->image = $path;
        }

        $team->update($request->only('name_en', 'name_ar', 'position_en', 'position_ar'));

        return response()->json($team);
    }

    public function destroy($id)
    {
        $team = Ourteam::findOrFail($id);

        Storage::disk('public')->delete($team->image);

        $team->delete();

        return response()->json(['message' => 'Team member deleted successfully.']);
    }
    
}
