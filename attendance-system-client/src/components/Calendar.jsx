import { useState, useEffect } from 'react';
import api from '../services/api';

const Calendar = () => {
  const [calendar, setCalendar] = useState([]);
  const [holiday, setHoliday] = useState(null);

  useEffect(() => {
    const fetchCalendar = async () => {
      const response = await api.get('/calendars');
      setCalendar(response.data);
    };
    fetchCalendar();
  }, []);

  const handleClickDate = (date) => {
    const selectedHoliday = calendar.find((day) => day.date === date);
    setHoliday(selectedHoliday);
  };

  return (
    <div>
      <h2>Calendar</h2>
      <table>
        <thead>
          <tr>
            <th>Sun</th>
            <th>Mon</th>
            <th>Tue</th>
            <th>Wed</th>
            <th>Thu</th>
            <th>Fri</th>
            <th>Sat</th>
          </tr>
        </thead>
        <tbody>
          {calendar.map((week, index) => (
            <tr key={index}>
              {week.map((day) => (
                <td
                  key={day.date}
                  onClick={() => handleClickDate(day.date)}
                >
                  {day.date.substring(8)}
                  {day.is_holiday && <span>(休日)</span>}
                </td>
              ))}
            </tr>
          ))}
        </tbody>
      </table>
      {holiday && (
        <div>
          <h3>{holiday.holiday_name}</h3>
          <p>{holiday.is_holiday ? '休日です' : '平日です'}</p>
        </div>
      )}
    </div>
  );
};

export default Calendar;


