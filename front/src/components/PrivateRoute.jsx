// src/components/PrivateRoute.js
import React from 'react';
import { Navigate } from 'react-router-dom';

const PrivateRoute = ({ children }) => {
  const token = localStorage.getItem('token'); // Ou como você estiver gerenciando o token

  return token ? children : <Navigate to="/login" />;
};

export default PrivateRoute;
