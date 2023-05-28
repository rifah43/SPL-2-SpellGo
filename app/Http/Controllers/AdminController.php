<?php

namespace App\Http\Controllers;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\GameController;
class AdminController extends Controller
{
    public function index(){
        $user = auth()->user();

        if ($user->role === 'admin') {
            return Inertia::render('AdminDashboard');
        }
        else{
            return Inertia::render('Dashboard');
        }
    }
    public function addQuestion(){
        $user = auth()->user();

        if ($user->role !== 'admin') {
            return redirect()->route('dashboard');
        }
        $question = Question::with('answer')->get();
        return view('quiz.questions',compact('question'));
    }
    public function add(){
        $user = auth()->user();

        if ($user->role !== 'admin') {
            return redirect()->route('dashboard');
        }
        return Inertia::render('Quiz/AddQuestion');
    }
    public function addQA(Request $request){
        try{
            $questionId = Question::insertGetId([
                'question' => $request->input('question')
            ]);
            $options = $request->input('answer');
            $correctIndex = $request->input('correct_answer_index');
            foreach ($options as $index => $option) {
                $isCorrect = $index == $correctIndex ? true : false;
                Answer::insert([
                    'question_id' => $questionId,
                    'answer' => $option,
                    'is_correct' => $isCorrect
                ]);
            }
            return response()->json(['success' => true]);
        } catch(\Exception $e){
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function delete(Request $request)
    {
        Question::where('id',$request->id)->delete();
        Answer::where('question_id',$request->id)->delete();
        return response()->json(['success' => true, 'message' => 'Question deleted successfully!']);
    }
}
