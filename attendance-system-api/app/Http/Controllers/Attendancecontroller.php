<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Attendance\AttendanceRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    protected $attendanceRepository;

    public function __construct(AttendanceRepositoryInterface $attendanceRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
    }

    // 一覧表示機能
    public function index()
    {
        $attendances = $this->attendanceRepository->getAll();
        return response()->json($attendances);
    }

    // 単一データ表示機能
    public function show($id)
    {
        $attendance = $this->attendanceRepository->findById($id);
        return response()->json($attendance);
    }

    // データ作成機能
    public function store(Request $request)
    {
        // バリデーションルールの定義
        $rules = [
            'user_id' => 'required|integer|exists:users,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late'
        ];

        // バリデーション
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $attendance = $this->attendanceRepository->create($request->all());
        return response()->json($attendance, 201);
    }

    // データ更新機能
    public function update(Request $request, $id)
    {
        $attendance = $this->attendanceRepository->findById($id);

        // バリデーションルールの定義
        $rules = [
            'user_id' => 'required|integer|exists:users,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late'
        ];

        // バリデーション
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $attendance = $this->attendanceRepository->update($id, $request->all());
        return response()->json($attendance, 200);
    }

    // データ削除機能
    public function destroy($id)
    {
        $this->attendanceRepository->delete($id);
        return response()->json(null, 204);
    }
}


