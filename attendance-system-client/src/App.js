import {Routes,Route } from 'react-router-dom';
import Login from './components/Login';
import Attendance from './components/Attendance';
import Calendar from './components/Calendar';


function App() {
  return (
    <div>
      <Routes>
        <Route exact path={"/"} element={<Login />} />
        <Route path={"/attendance"} element={<Attendance />} />
        <Route path={"/calendar"} element={<Calendar />} />
      </Routes>
    </div>
  );
}

export default App;
