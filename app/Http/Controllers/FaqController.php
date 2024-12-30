<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        return response()->json($faqs, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_ar' => 'required|string|max:255',
            'question_en' => 'required|string|max:255',
            'answer_ar' => 'required|string',
            'answer_en' => 'required|string',
        ]);

        $faq = Faq::create($request->all());

        return response()->json([
            'message' => 'FAQ created successfully',
            'data' => $faq,
        ], 201);
    }

    public function show($id)
    {
        $faq = Faq::findOrFail($id);
        return response()->json($faq, 200);
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $request->validate([
            'question_ar' => 'required|string|max:255',
            'question_en' => 'required|string|max:255',
            'answer_ar' => 'required|string',
            'answer_en' => 'required|string',
        ]);

        $faq->update($request->all());

        return response()->json([
            'message' => 'FAQ updated successfully',
            'data' => $faq,
        ], 200);
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return response()->json(['message' => 'FAQ deleted successfully'], 200);
    }
}
