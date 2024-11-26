import React, { useState, useRef, useEffect } from 'react';
import './header.css';
import Logo from "../../assets/logo.png"

const Header = () => {

  return (
    <header>
        <div className="logo">
            <a href="index.html">
                <h1>VisualControl</h1>
                <img src={Logo} className="logo-image"/>
            </a>
        </div>
        <nav className="nav-container">
            <a href="index.html" className="button">Inicio</a>
            <a href="login.html" className="button">Login</a>
            <a href="quienes.html" className="button">¿Quiénes Somos?</a>
            <a href="usuario.html" className="button">Usuario</a>
        </nav>
    </header>
  );
};

export default Header;
