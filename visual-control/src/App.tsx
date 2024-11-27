import { useState } from 'react'
import { BrowserRouter as Router, useLocation } from 'react-router-dom';

import Header from './components/header/header'
import Footer from './components/footer/footer'
import AboutUs from './pages/About/AboutUs';
import LogIn from './pages/Login/LogIn';

import './App.css'
import "./styles/global.css"

function App() {
  return (
    <Router>
      <Header/>
      <div style= {{height: "90px"}} className= "section"/>
      <AboutUs/>
      <Footer/>
    </Router>
  )
}

export default App;
