<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Quiz;
use App\Models\Progress;
use App\Models\Level;
use App\Models\Reward;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuizResultMail;
use PDF;

class QuizController extends Controller
{
public function loadQuiz()
{
    $user = auth()->user();

    if ($user->role === 'admin') {
        echo $user->role;
        return redirect()->route('dashboard');
    }
    
    $questions = Question::inRandomOrder()->limit(10)->with('answer')->get();
    return view('quiz.quiz', compact('questions'));
}

public function evaluateQuiz(Request $request)
{
    $user = auth()->user();

    if ($user->role !== 'user') {
        return redirect()->route('dashboard');
    }

    $questions = $request->input('questions');
    $time = $request->input('time');
    $score = 0;
    $correct = 0;
    $results = [];

    foreach ($questions as $question_id) {
        $selected_answer_id = $request->input('answer_' . $question_id);
        $question = Question::with('answer')->find($question_id);

        $selected_answer = $question->answer->where('id', $selected_answer_id)->first();
        $is_correct = ($selected_answer && $selected_answer->is_correct);

        if ($is_correct) {
            $correct++;
        }

        $results[] = [
            'question' => $question->question,
            'selected_answer' => $selected_answer ? $selected_answer->answer : 'Not answered',
            'correct_answer' => $is_correct ? 'Correct' : 'Incorrect',
            'correct_answer_text' => $question->answer->where('is_correct', true)->first()->answer,
        ];
    }

    $score = 10*(((300 - $time) / 300)/2 + ($correct/10)/2);

    $data = [
        'score' => $score,
        'correct' => $correct,
        'incorrect' => 10 - $correct,
    ];
    $pdf = PDF::loadView('quiz.result-pdf', compact('data', 'results'));

    Quiz::insert([
        'user_id' => $user->id,
        'time_needed' => $time,
    ]);

    $reward = Reward::create([
        'user_id' => $user->id,
        'points' => $score,
    ]);

    Mail::to($user->email)->send(new QuizResultMail($data, $results, $pdf));

    return view('quiz.result', compact('data', 'results'));
}
}
