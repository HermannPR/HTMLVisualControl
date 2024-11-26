import { useState } from 'react'
import { BrowserRouter as Router, useLocation } from 'react-router-dom';
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'
import Header from './components/header/header'
import Footer from './components/footer/footer'
import "./styles/global.css"
import AboutUs from './pages/About/AboutUs';

function App() {
  const [count, setCount] = useState(0)

  return (
    <Router>
      <Header/>
      
      <Footer/>
    </Router>
  )
}

export default App;
