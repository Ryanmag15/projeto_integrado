// src/context/AuthContext.jsx
import React, { createContext, useContext, useState, useEffect } from 'react';

const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
    const [token, setToken] = useState('');

    useEffect(() => {
        const storedToken = localStorage.getItem('access-token'); // Tente obter o token do localStorage
        console.log("storedToken", storedToken);
        if (storedToken) {
            setToken(storedToken);
        }
    }, []);

    return (
        <AuthContext.Provider value={{ token, setToken }}>
            {children}
        </AuthContext.Provider>
    );
};

export const useAuth = () => useContext(AuthContext);
