import { useState, useEffect } from 'react';
import api from '../services/api';

const Attendance = () => {
  const [attendance, setAttendance] = useState(null);
  const [clockedIn, setClockedIn] = useState(false);

  const handleClockIn = async () => {
    try {
      const response = await api.post('/attendances', {
        clock_in: new Date().toISOString(),
      });
      setAttendance(response.data);
      setClockedIn(true);
    } catch (error) {
      console.error(error);
    }
  };

  const handleClockOut = async () => {
    try {
      const response = await api.put(`/attendances/${attendance.id}`, {
        clock_out: new Date().toISOString(),
      });
      setAttendance(response.data);
      setClockedIn(false);
    } catch (error) {
      console.error(error);
    }
  };

  useEffect(() => {
    const fetchAttendance = async () => {
      try {
        const response = await api.get('/attendances');
        if (response.data.length > 0) {
          const latestAttendance = response.data[response.data.length - 1];
          if (latestAttendance.clock_out === null) {
            setAttendance(latestAttendance);
            setClockedIn(true);
          }
        }
      } catch (error) {
        console.error(error);
      }
    };
    fetchAttendance();
  }, []);

  if (attendance === null) {
    return <div>Loading...</div>;
  }

  return (
    <div>
      <h2>Attendance</h2>
      <div>
        {clockedIn ? (
          <button onClick={handleClockOut}>Clock Out</button>
        ) : (
          <button onClick={handleClockIn}>Clock In</button>
        )}
      </div>
      <div>
        <p>Clocked in: {attendance.clock_in}</p>
        <p>Clocked out: {attendance.clock_out ?? '-'}</p>
      </div>
    </div>
  );
};

export default Attendance;

