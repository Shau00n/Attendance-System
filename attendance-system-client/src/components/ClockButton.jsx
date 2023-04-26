import React, { useState } from 'react';
import { clockIn, clockOut } from '../utils/api';

function ClockButton() {
  const [isClockedIn, setIsClockedIn] = useState(true);

  const handleClockIn = async () => {
    await clockIn();
    setIsClockedIn(false);
  };

  const handleClockOut = async () => {
    await clockOut();
    setIsClockedIn(true);
  };

  return (
    <div>
      {isClockedIn ? (
        <button onClick={handleClockIn}>出勤</button>
      ) : (
        <button onClick={handleClockOut}>退勤</button>
      )}
    </div>
  );
}

export default ClockButton;
