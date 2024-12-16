<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    //

    public function login(){
        return view('login');
    }

    public function index()
    {
        $todos = Todo::all();
        
        return view('index',compact('todos'));
    }

    public function myindex()
    {
        // $todosにデータを設定（例: Todoモデルから全データを取得）
        $todos = Todo::all();

        // ビューに$todosを渡す
        return view('myindex', compact('todos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:255',
            'due_date' => 'nullable|date',
        ]);

        Todo::create($validated);

        return redirect('/')->with('message', 'Todoが作成されました！');
    }


    public function destroy(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/')->with('message','Todoを完了しました！');
    }
}
