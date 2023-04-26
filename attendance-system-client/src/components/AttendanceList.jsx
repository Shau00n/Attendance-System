import React, { useState, useEffect } from 'react';
import { getAttendances } from '../utils/api';
import ClockButton from '../components/ClockButton';

function AttendanceList() {
  const [attendances, setAttendances] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      const data = await getAttendances();
      setAttendances(data);
    };
    fetchData();
  }, []);

  return (
    <div>
      <h2>勤務一覧</h2>
      <ul>
        {attendances.map((attendance) => (
          <li key={attendance.id}>
            {attendance.clock_in} - {attendance.clock_out || '出勤中'}
          </li>
        ))}
      </ul>
      <ClockButton />
    </div>
  );
}

export default AttendanceList;
