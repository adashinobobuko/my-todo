<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function __construct()
    {
        // 認証が必要な操作に対して auth ミドルウェアを適用
        $this->middleware('auth')->except(['index']);
    }
    
    
    public function login()
    {
        return view('login');
    }

    public function index()
    {
        $todos = Todo::all();
        return view('index', compact('todos'));
    }

    public function myindex()
    {
        // ログインユーザーが作成したTodoのみ取得
        $todos = Todo::where('user_id', Auth::id())->get();
        return view('myindex', compact('todos'));
    }

    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'content' => 'required|string|max:255',
            'due_date' => 'nullable|date',
        ]);

        // ログインユーザーIDをTodoに紐付けて保存
        Todo::create([
            'content' => $validated['content'],
            'due_date' => $validated['due_date'],
            'user_id' => Auth::id(), // ログインユーザーのIDを保存
        ]);

        return redirect('/')->with('message', 'Todoが作成されました！');
    }

    public function destroy(Request $request)
    {
        // Todoを取得
        $todo = Todo::findOrFail($request->id);

        // ログインユーザーが所有しているTodoか確認
        if ($todo->user_id !== Auth::id()) {
            abort(403, 'この操作は許可されていません。');
        }

        $todo->delete();
        return redirect('/')->with('message', 'Todoを完了しました！');
    }
}
