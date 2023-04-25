<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Calendar\CalendarRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class CalendarController extends Controller
{
    private $calendarRepository;

    public function __construct(CalendarRepositoryInterface $calendarRepository)
    {
        $this->calendarRepository = $calendarRepository;
    }

    // 一覧表示機能
    public function index()
    {
        $calendars = $this->calendarRepository->getAll();
        return response()->json($calendars);
    }

    // 単一データ表示機能
    public function show($id)
    {
        $calendar = $this->calendarRepository->findById($id);
        return response()->json($calendar);
    }

    // データ作成機能
    public function store(Request $request)
    {
        // バリデーションルールの定義
        $rules = [
            'title' => 'required',
            'date' => 'required|date',
        ];

        // バリデーション
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $calendar = $this->calendarRepository->create($request->all());
        return response()->json($calendar, 201);
    }

    // データ更新機能
    public function update(Request $request, $id)
    {
        // バリデーションルールの定義
        $rules = [
            'title' => 'required',
            'date' => 'required|date',
        ];

        // バリデーション
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $calendar = $this->calendarRepository->update($id, $request->all());
        return response()->json($calendar, 200);
    }

    // データ削除機能
    public function destroy($id)
    {
        $this->calendarRepository->delete($id);
        return response()->json(null, 204);
    }
}
