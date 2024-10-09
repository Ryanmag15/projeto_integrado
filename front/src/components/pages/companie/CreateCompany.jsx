// src/pages/CreateCompany.js
import React, { useState } from 'react';
import { Container, TextField, Button, Typography } from '@mui/material';
import axios from 'axios';
import { useAuth } from '../../../context/AuthContext';
import { useNavigate } from 'react-router-dom';
import useHttp from '../../hooks/useHttp';

const CreateCompany = () => {
    const {post, get } = useHttp();
    const { token } = useAuth(); // Obtém o token do contexto de autenticação
    const navigate = useNavigate();
    const [company, setCompany] = useState({
        name: '',
        address: '',
        city: '',
        state: '',
        zip_code: '',
        country: ''
    });

    const handleChange = (e) => {
        setCompany({ ...company, [e.target.name]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        // Lógica para enviar a nova empresa para a API
        try {
            await post('/company', company);
            navigate('/companies');
        } catch (error) {
            console.error(error);
        }
    };
    

    return (
        <Container>
            <Typography variant="h4" gutterBottom>
                Adicionar Empresa
            </Typography>
            <form onSubmit={handleSubmit}>
                <TextField
                    label="Nome"
                    name="name"
                    value={company.name}
                    onChange={handleChange}
                    fullWidth
                    required
                />
                <TextField
                    label="Endereço"
                    name="address"
                    value={company.address}
                    onChange={handleChange}
                    fullWidth
                    sx={{ mt: 2 }}
                />
                <TextField
                    label="Cidade"
                    name="city"
                    value={company.city}
                    onChange={handleChange}
                    fullWidth
                    sx={{ mt: 2 }}
                />
                <TextField
                    label="Estado"
                    name="state"
                    value={company.state}
                    onChange={handleChange}
                    fullWidth
                    sx={{ mt: 2 }}
                />
                <TextField
                    label="Código Postal"
                    name="zip_code"
                    value={company.zip_code}
                    onChange={handleChange}
                    fullWidth
                    sx={{ mt: 2 }}
                />
                <TextField
                    label="País"
                    name="country"
                    value={company.country}
                    onChange={handleChange}
                    fullWidth
                    sx={{ mt: 2 }}
                />
                <Button type="submit" variant="contained" color="primary" sx={{ mt: 3 }}>
                    Adicionar Empresa
                </Button>
            </form>
        </Container>
    );
};

export default CreateCompany;
