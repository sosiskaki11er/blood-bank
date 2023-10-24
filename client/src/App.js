import BloodImg from './assets/img/svg.png'
import HeartLogo from './assets/icons/activity-heart.svg'
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom'
import Auth from './pages/Auth';

function App() {
  return (
    <Router>
      <Routes>
        <Route path='/' element={<Auth/>}/>
      </Routes>
    </Router>

  );
}

export default App;
