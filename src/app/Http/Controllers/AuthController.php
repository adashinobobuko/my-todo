<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
        // ログインフォーム表示
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        // バリデーション
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 認証試行
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/mypage'); // 成功時のリダイレクト
        }

        // 認証失敗時
        return back()->withErrors([
            'email' => '認証情報が正しくありません。',
        ])->onlyInput('email');
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::logout();//ユーザーをログアウトさせる

        $request->session()->invalidate();
        //セッションを無効化
        $request->session()->regenerateToken();
        //csrfトークンを再生成
        return redirect('/login');//ログインページにリダイレクト
    }
}
