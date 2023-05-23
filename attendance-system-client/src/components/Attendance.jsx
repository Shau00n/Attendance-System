import { useState, useEffect } from 'react';
import api from '../services/api';
import styled from 'styled-components';

const StyledAttendance = styled.div`
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f5f5f5;
  border-radius: 5px;
`;

const AttendanceButton = styled.button`
  margin-top: 10px;
  padding: 10px 20px;
  font-size: 16px;
  background-color: ${(props) => (props.clockedIn ? '#dc3545' : '#28a745')};
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
`;

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
    <StyledAttendance>
      <h2>Attendance</h2>
      <div>
        {clockedIn ? (
          <AttendanceButton clockedIn={clockedIn} onClick={handleClockOut}>
            Clock Out
          </AttendanceButton>
        ) : (
          <AttendanceButton clockedIn={clockedIn} onClick={handleClockIn}>
            Clock In
          </AttendanceButton>
        )}
      </div>
      <div>
        <p>Clocked in: {attendance.clock_in}</p>
        <p>Clocked out: {attendance.clock_out ?? '-'}</p>
      </div>
    </StyledAttendance>
  );
};

export default Attendance;
