import { useState, useEffect } from 'react';
import api from '../services/api';
import styled, { ThemeProvider } from 'styled-components';

// テーマを定義
const theme = {
  colors: {
    primary: '#ffc107',
    secondary: '#fff',
  },
};

const StyledCalendar = styled.div`
  max-width: 600px;
  margin: 0 auto;
`;

const CalendarTable = styled.table`
  width: 100%;
  margin-bottom: 20px;
  border-collapse: collapse;
`;

const CalendarHeader = styled.th`
  background-color: #f8f9fa;
  padding: 10px;
`;

const CalendarCell = styled.td`
  padding: 10px;
  cursor: pointer;
  // テーマから色を取得
  background-color: ${(props) =>
    props['is-holiday'] ? props.theme.colors.primary : props.theme.colors.secondary};
`;

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
    // ThemeProviderでコンポーネントを囲む
    <ThemeProvider theme={theme}>
      <StyledCalendar>
        <h2>Calendar</h2>
        <CalendarTable>
          <thead>
            <tr>
              <CalendarHeader>Sun</CalendarHeader>
              <CalendarHeader>Mon</CalendarHeader>
              <CalendarHeader>Tue</CalendarHeader>
              <CalendarHeader>Wed</CalendarHeader>
              <CalendarHeader>Thu</CalendarHeader>
              <CalendarHeader>Fri</CalendarHeader>
              <CalendarHeader>Sat</CalendarHeader>
            </tr>
          </thead>
          <tbody>
            {calendar.map((week, index) => (
              <tr key={index}>
                {week.map((day) => (
                  // propsの名前をis-holidayに変更
                  <CalendarCell
                    key={day.date}
                    onClick={() => handleClickDate(day.date)}
                    is-holiday={day.is_holiday}
                  >
                    {day.date.substring(8)}
                    {day.is_holiday && <span>(休日)</span>}
                  </CalendarCell>
                ))}
              </tr>
            ))}
          </tbody>
        </CalendarTable>
        {holiday && (
          <div>
            <h3>{holiday.holiday_name}</h3>
            <p>{holiday.is_holiday ? '休日です' : '平日です'}</p>
          </div>
        )}
      </StyledCalendar>
    </ThemeProvider>
  );
};

export default Calendar;
