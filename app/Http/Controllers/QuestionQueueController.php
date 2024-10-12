<?php

namespace App\Http\Controllers;

use App\Models\QuestionQueue;
use Illuminate\Http\Request;

class QuestionQueueController extends Controller
{
    public function index()
    {
        // Eager load 'partner'
        $queues = QuestionQueue::with(['partner','question'])->paginate(10);
        return response()->json($queues, 200);
    }

    /**
     * Lưu một queue câu hỏi mới.
     */
    public function store(Request $request)
    {
        // Xác thực dữ liệu trực tiếp trong Controller
        $validatedData = $request->validate([
            'question_id' => 'required|integer',
            'partner_id' => 'required|string|max:255',
        ]);

        $queue = QuestionQueue::create($validatedData);
        // Tải lại mối quan hệ 'partner' sau khi tạo mới
        $queue->load('partner');
        return response()->json($queue, 201);
    }

    /**
     * Hiển thị thông tin một queue câu hỏi cụ thể
     */
    public function show($id)
    {
        // Eager load 'partner' 
        $queue = QuestionQueue::with(['partner','question'])->find($id);
        if (!$queue) {
            return response()->json(['message' => 'Queue not found'], 404);
        }
        return response()->json($queue, 200);
    }

    /**
     * Cập nhật một queue câu hỏi cụ thể.
     */
    public function update(Request $request, $id)
    {
        $queue = QuestionQueue::find($id);
        if (!$queue) {
            return response()->json(['message' => 'Queue not found'], 404);
        }

        $validatedData = $request->validate([
            'question_id' => 'sometimes|required|integer|exists:questions,id',
            'partner_id' => 'sometimes|required|string|max:255',
        ]);

        $queue->update($validatedData);
        // Tải lại mối quan hệ 'partner' sau khi cập nhật
        $queue->load(['partner','question']);
        return response()->json($queue, 200);
    }

    /**
     * Xóa một queue câu hỏi cụ thể.
     */
    public function destroy($id)
    {
        $queue = QuestionQueue::find($id);
        if (!$queue) {
            return response()->json(['message' => 'Queue not found'], 404);
        }
        $queue->delete();
        return response()->json(['message' => 'Queue deleted successfully'], 200);
    }
}
