<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Laravel\Passport\PersonalAccessTokenResult;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // バリデーションやエラーハンドリングは省略
        $data = $request->all();

        // ユーザー登録の処理
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // APIトークンの発行
        $token = $user->createToken('user-token');

        // レスポンスの返却
        return response()->json([
            'user' => $user,
            'token' => $token->accessToken,
        ]);
    }

    public function login(Request $request)
    {
        // バリデーションやエラーハンドリングは省略
        $credentials = $request->only('email', 'password');

        // 認証の処理
        if (Auth::attempt($credentials)) {
            // 認証成功時
            $user = Auth::user();

            // APIトークンの発行
            $token = $user->createToken('user-token');

            // レスポンスの返却
            return response()->json([
                'user' => $user,
                'token' => $token->accessToken,
            ]);
        } else {
            // 認証失敗時
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function logout(Request $request)
    {
        // 認証済みユーザーの取得
        $user = Auth::user();

        // APIトークンの削除
        $user->tokens()->delete();

        // レスポンスの返却
        return response()->json(['message' => 'Logged out successfully']);
    }

    // 他の認証関連のメソッドを追加...
}
