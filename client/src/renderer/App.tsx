import { MemoryRouter as Router, Routes, Route} from 'react-router-dom'
import Auth from './pages/Auth';
import Main from './pages/Main';
import Reset from './pages/Reset';
import "./App.css";

function App() {
  return (
    <Router>
      <Routes>
        <Route path='/' element={<Auth/>}/>
        <Route path='/main/*' element={<Main/>}/>
        <Route path='/reset' element={<Reset/>}/>
      </Routes>
    </Router>

  );
}

export default App;