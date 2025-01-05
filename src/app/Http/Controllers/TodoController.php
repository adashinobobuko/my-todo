<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;
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
        //$todos = Todo::all();
        //カテゴリーとのリレーション
        $todos = Todo::with('category')->get();
        $categories = Category::all();
        return view('index', compact('todos','categories'));
    }

    public function mypage()
    {
        // ログインユーザーが作成したTodoのみ取得
        $todos = Todo::where('user_id', Auth::id())->get();
        $categories = Category::all();
        return view('myindex', compact('todos','categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:255',
            'due_date' => 'required|date',
            'category_id' => 'required|exists:categories,id',//カテゴリーIDを追加
        ]);

        Todo::create([
            'content' => $request->content,
            'due_date' => $request->due_date,
            'user_id' => Auth::id(), // ログイン中のユーザーIDを保存
            'category_id' => $validated['category_id'],//カテゴリーIDを追加
        ]);

        return redirect('/my')->with('message', 'Todoを作成しました！');
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
        return redirect('/my')->with('message', 'Todoを完了しました！');
    }

    public function search(Request $request)
    {
        // カテゴリIDで検索
        $todos = Todo::with('category')
            ->CategorySearch($request->category_id)
            ->where('user_id', Auth::id()) // ログインユーザーのTodoのみ表示
            ->get();

        $categories = Category::all();

        return view('myindex', compact('todos', 'categories'));
    }
}
