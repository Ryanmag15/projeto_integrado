import React, { useEffect, useState } from 'react';
import { Container, TextField, Button, Typography } from '@mui/material';
import axios from 'axios';
import { useAuth } from '../../../context/AuthContext';
import { useParams, useNavigate } from 'react-router-dom';

const EditCompany = () => {
    const { token } = useAuth(); // Obtém o token do contexto de autenticação
    const { id } = useParams(); // Obtém o ID da empresa da URL
    const [company, setCompany] = useState({
        name: '',
        address: '',
        city: '',
        state: '',
        zip_code: '',
        country: ''
    });
    const navigate = useNavigate(); // Para redirecionar após a edição

    // Função para buscar os detalhes da empresa ao carregar o componente
    useEffect(() => {
        const fetchCompanyDetails = async () => {
            try {
                const response = await axios.get(`http://localhost:8000/company/${id}`, {
                    headers: {
                        Authorization: `Bearer ${token}`, // Adiciona o token no cabeçalho
                    },
                });
                setCompany(response.data); // Define os dados da empresa no estado
            } catch (error) {
                console.error('Erro ao buscar detalhes da empresa:', error);
            }
        };

        fetchCompanyDetails();
    }, [id, token]);

    const handleChange = (e) => {
        setCompany({ ...company, [e.target.name]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            await axios.put(`http://localhost:8000/company/${id}`, company, {
                headers: {
                    Authorization: `Bearer ${token}`, // Adiciona o token no cabeçalho
                },
            });
            console.log('Empresa editada com sucesso!');
            navigate('/companies'); // Redireciona para a lista de empresas após a edição
        } catch (error) {
            console.error('Erro ao editar empresa:', error);
        }
    };

    return (
        <Container>
            <Typography variant="h4" gutterBottom>
                Editar Empresa
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
                    Salvar Alterações
                </Button>
            </form>
        </Container>
    );
};

export default EditCompany;
