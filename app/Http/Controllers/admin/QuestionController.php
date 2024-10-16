<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Service\QuestionService;
use Illuminate\Support\Facades\Redirect;

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
            return redirect()->back()->with('error', 'Type này phải có file truyền vào');;
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
    }


    public function showEditQuestion(Request $request)
    {
        $id = $request->id;
        $questionInfo = Question::find($id);
        $choice = $questionInfo->choice;
        $questionInfo->a = $choice['A'];
        $questionInfo->b = $choice['B'];
        $questionInfo->c = $choice['C'];
        $questionInfo->d = $choice['D'];
        return view('admin.question.edit_question', compact('questionInfo'));
    }

    public function editQuestion(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|max:255',
            'type' => 'required',
            'content' => 'string',
            'result' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
        ]);

        $id = $request->id;

        $question = Question::find($id);
        if (!$question) {
            return redirect()->back()->with('error', 'Không tìm thấy câu hỏi');
        }

        $data = $request->all();

        $choices = [
            "A" => $data['a'],
            "B" => $data['b'],
            "C" => $data['c'],
            "D" => $data['d'],
        ];

        $data['choice'] = $choices;

        unset($data['a'], $data['b'], $data['c'], $data['d']);

        if ($question->type == 0) {
            if ($data['type'] != 0 && !$request->hasFile('file')) {
                return redirect()->back()->with('error', 'Chưa chọn file');
            }
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

        return redirect(route('admin.question.index'))->with('success', 'Sửa câu hỏi thành công');
    }

    public function editStatusQuestion(Request $request) {
        $id = $request->id;
        $activate = $request->activate;
        $question = Question::find($id);

        if (!$question) {
            return redirect()->route('admin.question.index')->with('error', 'Không tìm thấy câu hỏi');
        }
        $question->activate = $activate;
        $message = $activate == 1 ? "Mở câu hỏi thành công" : "Khóa câu hỏi thành công";
        $question->save();

        return redirect()->route('admin.question.index')->with('success', $message);
    }

    public function deleteQuestion(Request $request)
    {
        $id = $request->id;

        $question = Question::find($id);
        if (!$question) {
            return redirect()->route('admin.question.index')->with('error', 'Không tìm thấy câu hỏi');
        }

        // $question->activate = $request->input('activate');
        $question->delete();

        return redirect()->route('admin.question.index')->with('success', 'Xóa câu hỏi thành công');
    }

}
