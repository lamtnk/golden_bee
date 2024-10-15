<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Service\QuestionService;

class QuestionController extends Controller
{
    private $questionService;

    //
    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    public function index()
    {
        $questions = Question::all();
        foreach ($questions as $key => $item) {
            if ($item->type != 0) {
                $questions[$key]->content_url = url($item->content);
            }
        }
        return view('admin.question.question', compact('questions'));
    }

    public function showAddQuestion()
    {
        return view('admin.question.add_question');
    }

    public function addQuestion(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'type' => 'required',
            'content' => 'string',
            'result' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
        ]);

        $data = $request->all();

        $choices = [
            "A" => $data['a'],
            "B" => $data['b'],
            "C" => $data['c'],
            "D" => $data['d'],
        ];

        $data['choice'] = $choices;

        unset($data['a'], $data['b'], $data['c'], $data['d']);

        if ($data['type'] != 0 && !$request->file) {
            return response()->json(['message' => 'Type này phải có file truyền vào'], 404);
        }

        if ($data['type'] != 0 && $request->file) {
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

        return redirect(route('admin.question.index'))->with('success', 'Thêm câu hỏi thành công');
//     }

}

//     public function showEditQuestion(Request $request)
//     {
//         $id = $request->id;
//         $allCategory = $this->categoryService->getAll();
//         $productInfo = $this->productService->getById($id);
//         $allVariations = $this->variationService->getAll();
//         return view('admin.product.edit_product', compact('id', 'productInfo', 'allCategory', 'allVariations'));
//     }

//     public function editQuestion(Request $request)
//     {
//         $request->validate([
//             'id' => 'required',
//             'category_id' => 'required',
//             'product_name' => 'required',
//             'product_name_en' => 'required',
//         ]);
//         $id = $request->id;
//         $categoryId = $request->category_id;
//         $productName = $request->product_name;
//         $productNameEn = $request->product_name_en;
//         $productPrice = $request->product_price;
//         $productDescription = $request->product_description ?? null;
//         $productDescriptionEn = $request->product_description_en ?? null;
//         if ($request->product_image && $request->product_image != 'undefined') {
//             $imageName = time() . '_' . $request->product_image->getClientOriginalName();
//             $request->product_image->move(public_path('img/client/shop'), $imageName);
//             $oldImagePath = $this->productService->getById($request->id)->image;
//             if (file_exists(public_path('img/client/shop') . '/' . $oldImagePath)) {
//                 unlink(public_path('img/client/shop') . '/' . $oldImagePath);
//             }
//         }
//         return $this->productService->edit($id, $categoryId, $productName, $productNameEn, $productPrice, $productDescription, $productDescriptionEn, $imageName ?? null);
//     }

//     public function deleteQuestion(Request $request)
//     {
//         $id = $request->id;
//         if($this->productService->checkHasPromotion($id)) {
//             return redirect(route('admin.product.index'))->with('error', 'Sản phẩm đang khuyễn mãi không thể xóa');
//         }
//         $this->productService->delete($id);
//         return redirect(route('admin.product.index'))->with('success', 'Ẩn thực phẩm thành công');
//     }

}
