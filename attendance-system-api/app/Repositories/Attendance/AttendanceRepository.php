<?php

namespace App\Repositories\Attendance;

use App\Models\Attendance;

class AttendanceRepository
{
    protected $attendance;

    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    // 一覧表示機能
    public function getAll()
    {
        return $this->attendance->all();
    }

    // 単一データ表示機能
    public function getById($id)
    {
        return $this->attendance->findOrFail($id);
    }

    // データ作成機能
    public function create(array $data)
    {
        return $this->attendance->create($data);
    }

    // データ更新機能
    public function update($id, array $data)
    {
        $attendance = $this->getById($id);
        $attendance->update($data);

        return $attendance;
    }

    // データ削除機能
    public function delete($id)
    {
        $attendance = $this->getById($id);
        $attendance->delete();
    }
}
