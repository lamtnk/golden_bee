<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
     /**
     * Hiển thị danh sách tất cả các người chơi với thông tin các queue câu hỏi.
     */
    public function index()
    {
        // Eager load 'questionQueues'
        $partners = Partner::with('questionQueues.question')->paginate(10);
        return response()->json($partners, 200);
    }

    /**
     * Lưu một người chơi mới.
     */
    public function store(Request $request)
    {
        // Xác thực dữ liệu trực tiếp trong Controller
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $partner = Partner::create($validatedData);
        // Tải lại mối quan hệ 'questionQueues' sau khi tạo mới
        $partner->load('questionQueues.question');
        return response()->json($partner, 201);
    }

    /**
     * Hiển thị thông tin một người chơi cụ thể với thông tin các queue câu hỏi.
     */
    public function show($id)
    {
        // Eager load 'questionQueues'
        $partner = Partner::with('questionQueues.question')->find($id);
        if (!$partner) {
            return response()->json(['message' => 'Partner not found'], 404);
        }
        return response()->json($partner, 200);
    }

    /**
     * Cập nhật một người chơi cụ thể.
     */
    public function update(Request $request, $id)
    {
        $partner = Partner::find($id);
        if (!$partner) {
            return response()->json(['message' => 'Partner not found'], 404);
        }

        // Xác thực dữ liệu trực tiếp trong Controller
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
        ]);

        $partner->update($validatedData);
        // Tải lại mối quan hệ 'questionQueues' sau khi cập nhật
        $partner->load('questionQueues.question');
        return response()->json($partner, 200);
    }

    /**
     * Xóa một người chơi cụ thể.
     */
    public function destroy($id)
    {
        $partner = Partner::find($id);
        if (!$partner) {
            return response()->json(['message' => 'Partner not found'], 404);
        }
        $partner->delete();
        return response()->json(['message' => 'Partner deleted successfully'], 200);
    }
}
