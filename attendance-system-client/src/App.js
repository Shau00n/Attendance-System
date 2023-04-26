import { BrowserRouter as Router,Route } from 'react-router-dom';
import Login from './components/Login';
import Attendance from './components/Attendance';
import Calendar from './components/Calendar';


function App() {
  return (
    <Router>
      <Route exact path={"/"} element={<Login />} />
      <Route path={"/attendance"} element={<Attendance />} />
      <Route path={"/calendar"} element={<Calendar />} />
    </Router>
  );
}

export default App;
