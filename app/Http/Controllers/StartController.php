<?php

namespace App\Http\Controllers;

use App\Models\Start;
use Illuminate\Http\Request;

class StartController extends Controller
{
    public function index()
    {
        // Phân trang kết quả, mỗi trang có 10 bản ghi
        $starts = Start::paginate(10);
        return response()->json($starts, 200);
    }

    /**
     * Lưu một Start mới.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'activate' => 'required|boolean',
        ]);

        // Tạo mới Start
        $start = Start::create($validatedData);
        return response()->json($start, 201);
    }

    public function show($id)
    {
        $start = Start::find($id);
        if (!$start) {
            return response()->json(['message' => 'Start not found'], 404);
        }
        return response()->json($start, 200);
    }

    public function update(Request $request, $id)
    {
        $start = Start::find($id);
        if (!$start) {
            return response()->json(['message' => 'Start not found'], 404);
        }

        $validatedData = $request->validate([
            'activate' => 'sometimes|required|boolean',
        ]);

        // Cập nhật Start
        $start->update($validatedData);
        return response()->json($start, 200);
    }

    public function destroy($id)
    {
        $start = Start::find($id);
        if (!$start) {
            return response()->json(['message' => 'Start not found'], 404);
        }
        $start->delete();
        return response()->json(['message' => 'Start deleted successfully'], 200);
    }
}
