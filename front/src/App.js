import React from 'react';
import { BrowserRouter as Router, Route, Routes, Navigate } from 'react-router-dom';
import { Container } from '@mui/material';
import { AuthProvider } from './context/AuthContext'; // Importa o AuthProvider
import Login from './components/auth/Login';
import Register from './components/auth/Register';
import Home from './components/dashboard/Home';
import PrivateRoute from './components/PrivateRoute';
import Header from './components/layout/Header';
import CompanyList from './components/pages/companie/CompanyList'; // Nova rota para listar empresas
import CreateCompany from './components/pages/companie/CreateCompany'; // Nova rota para criar uma nova empresa
import EditCompany from './components/pages/companie/EditCompany';

function App() {
    return (
        <AuthProvider> {/* Envolva o aplicativo com o AuthProvider */}
            <Router>
                <Container
                    maxWidth={false} // Remove a limitação de largura
                    sx={{ width: '100%', height: '100vh', padding: 0 }} // Define a largura e altura como 100%
                >
                    <Routes>
                        <Route path="/" element={<Navigate to="/login" />} />
                        <Route path="/login" element={<Login />} />
                        <Route path="/register" element={<Register />} />
                        <Route
                            path="/home"
                            element={
                                <PrivateRoute>
                                    <Header />
                                    <Home />
                                </PrivateRoute>
                            }
                        />
                        <Route
                            path="/companies"
                            element={
                                <PrivateRoute>
                                    <Header />
                                    <CompanyList /> {/* Rota para listar empresas */}
                                </PrivateRoute>
                            }
                        />
                        <Route
                            path="/create-company"
                            element={
                                <PrivateRoute>
                                    <Header />
                                    <CreateCompany /> {/* Rota para criar uma nova empresa */}
                                </PrivateRoute>
                            }
                        />
                        <Route
                            path="/edit-company/:id"
                            element={
                                <PrivateRoute>
                                    <Header />
                                    <EditCompany /> {/* Rota para criar uma nova empresa */}
                                </PrivateRoute>
                            }
                        />
                        
                    </Routes>
                </Container>
            </Router>
        </AuthProvider>
    );
}

export default App;
