<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return response()->json($questions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|integer|between:0,3',
            'content' => 'required|string',
            'result' => 'required|string',
        ]);

        $data = $request->all();

        if ($data['type'] != 0 && !$request->hasFile('file')) {
            return response()->json(['message' => 'Type này phải có file truyền vào'], 404);
        }

        if ($data['type'] != 0 && $request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = '';

            switch ($data['type']) {
                case 1:
                    $filePath = 'file/images/' . $filename;
                    break;
                case 2:
                    $filePath = 'file/audios/' . $filename;
                    break;
                case 3:
                    $filePath = 'file/videos/' . $filename;
                    break;
            }

            $file->move(public_path('file/' . ($data['type'] == 1 ? 'images' : ($data['type'] == 2 ? 'audios' : 'videos'))), $filename);
            $data['content'] = $filePath;
        }

        $question = Question::create($data);

        return response()->json($question, 201);
    }

    public function show($id)
    {
        $question = Question::find($id);
        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }

        // Kiểm tra nếu content là đường dẫn tệp
        if ($question->type != 0) {
            $question->content_url = url($question->content);
        }

        return response()->json($question);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|integer|between:0,3',
            'content' => 'sometimes|required|string',
            'result' => 'sometimes|required|string',
        ]);

        $question = Question::find($id);
        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }
        
        $data = $request->all();
        
        if ($data['type'] != 0 && !$request->hasFile('file')) {
            return response()->json(['message' => 'Type này phải có file truyền vào'], 404);
        }

        // Xóa tệp cũ nếu có
        if ($question->content) {
            if (file_exists(public_path($question->content))) {
                unlink(public_path($question->content));
            }
        }
        if ($data['type'] != 0 && $request->hasFile('file')) {

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = '';

            switch ($data['type']) {
                case 1:
                    $filePath = 'file/images/' . $filename;
                    break;
                case 2:
                    $filePath = 'file/audios/' . $filename;
                    break;
                case 3:
                    $filePath = 'file/videos/' . $filename;
                    break;
            }

            $file->move(public_path('file/' . ($data['type'] == 1 ? 'images' : ($data['type'] == 2 ? 'audios' : 'videos'))), $filename);
            $data['content'] = $filePath;
        }

        $question->update($data);
        return response()->json($question);
    }

    public function destroy($id)
    {
        $question = Question::find($id);
        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }

        // Xóa tệp nếu có
        if ($question->content) {
            if (file_exists(public_path($question->content))) {
                unlink(public_path($question->content));
            }
        }

        $question->delete();
        return response()->json(['message' => 'Question deleted successfully']);
    }

    public function updateActivate(Request $request, $id)
    {
        // Xác thực dữ liệu
        $request->validate([
            'activate' => 'required|boolean',
        ]);

        $question = Question::find($id);
        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }

        $question->activate = $request->input('activate');
        $question->save();

        return response()->json([
            'message' => 'Activate status updated successfully',
            'question' => $question
        ], 200);
    }
}