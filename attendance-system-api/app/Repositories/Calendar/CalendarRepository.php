<?php

namespace App\Repositories\Calendar;

use App\Models\Calendar;

class CalendarRepository implements CalendarRepositoryInterface
{
    protected $calendar;

    public function __construct(Calendar $calendar)
    {
        $this->calendar = $calendar;
    }

    public function getAll()
    {
        return $this->calendar->all();
    }

    public function findById($id)
    {
        return $this->calendar->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->calendar->create($data);
    }

    public function update(array $data, $id)
    {
        $calendar = $this->calendar->findOrFail($id);
        $calendar->update($data);

        return $calendar;
    }

    public function delete($id)
    {
        $calendar = $this->calendar->findOrFail($id);
        $calendar->delete();

        return true;
    }
}
