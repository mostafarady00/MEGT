<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internationalfaq;

class InternationalfaqController extends Controller
{
    public function index()
    {
        return response()->json(Internationalfaq::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_ar' => 'required|string|max:255',
            'question_en' => 'required|string|max:255',
            'answer_ar' => 'required|string',
            'answer_en' => 'required|string',
        ]);

        $faq = Internationalfaq::create($request->only('question_ar', 'question_en', 'answer_ar', 'answer_en'));

        return response()->json($faq, 201);
    }

    public function show($id)
    {
        $faq = Internationalfaq::findOrFail($id);
        return response()->json($faq);
    }

    public function update(Request $request, $id)
    {
        $faq = Internationalfaq::findOrFail($id);

        $request->validate([
            'question_ar' => 'sometimes|string|max:255',
            'question_en' => 'sometimes|string|max:255',
            'answer_ar' => 'sometimes|string',
            'answer_en' => 'sometimes|string',
        ]);

        $faq->update($request->only('question_ar', 'question_en', 'answer_ar', 'answer_en'));

        return response()->json($faq);
    }

    public function destroy($id)
    {
        $faq = Internationalfaq::findOrFail($id);
        $faq->delete();

        return response()->json(['message' => 'FAQ deleted successfully.']);
    }
}
