<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all()->map(function ($blog) {
            $blog->image = url('public/storage/' . $blog->image);
            return $blog;
        });

        return response()->json($blogs);
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->image = url('public/storage/' . $blog->image);

        return response()->json($blog);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
        ]);

        $path = $request->file('image')->store('blogs', 'public');

        $blog = Blog::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'image' => $path,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
        ]);

        return response()->json($blog, 201);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title_ar' => 'sometimes|string|max:255',
            'title_en' => 'sometimes|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_ar' => 'sometimes|string',
            'description_en' => 'sometimes|string',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($blog->image);

            $path = $request->file('image')->store('blogs', 'public');
            $blog->image = $path;
        }

        $blog->update($request->only('title_ar', 'title_en', 'description_ar', 'description_en'));

        return response()->json($blog);
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        Storage::disk('public')->delete($blog->image);

        $blog->delete();

        return response()->json(['message' => 'Blog deleted successfully.']);
    }

}
