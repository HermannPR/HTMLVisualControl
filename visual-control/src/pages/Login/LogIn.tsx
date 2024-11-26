import React from 'react';
import "./LogIn.css"

const LogIn = () => 
{
    return (
        <section className="login">
            <div className="form-container">
                <h2>Login</h2>
                <form>
                    <input type="text" name="username" placeholder="Nombre de usuario" required />
                    <input type="password" name="password" placeholder="Contraseña" required />
                    <button type="submit">Iniciar Sesión</button>
                </form>
            </div>
        </section>
    );
};


export default LogIn;