// src/context/AuthContext.jsx
import React, { createContext, useContext, useState, useEffect } from "react";

const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
    const [token, setToken] = useState(() => localStorage.getItem("access-token") || "");

    useEffect(() => {
        const storedToken = localStorage.getItem("access-token");
        console.log("Token armazenado:", storedToken);
        if (storedToken) {
            setToken(storedToken);
        }
    }, []); // Apenas na montagem

    return (
        <AuthContext.Provider value={{ token, setToken }}>
            {children}
        </AuthContext.Provider>
    );
};

export const useAuth = () => useContext(AuthContext);