import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';
import './index.css'; // Verifique se você tem um arquivo de estilo se necessário

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);
