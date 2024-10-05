import React, { useEffect, useState } from 'react';
import {
    Typography,
    Button,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableHead,
    TableRow,
    Paper,
} from '@mui/material';
import { Link } from 'react-router-dom';
import axios from 'axios';
import { useAuth } from '../../../context/AuthContext';

const CompanyList = () => {
    const [companies, setCompanies] = useState([]);
    const { token } = useAuth();

    useEffect(() => {
        const fetchCompanies = async () => {
            if (!token) {
                console.error('Token está vazio, não é possível buscar empresas.');
                return;
            }
            try {
                const response = await axios.get('http://localhost:8000/company', {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });
                setCompanies(response.data);
            } catch (error) {
                console.error('Erro ao buscar empresas:', error);
            }
        };

        fetchCompanies();
    }, [token]);

    // Função para deletar a empresa
    const handleDelete = async (id) => {
        if (window.confirm("Você tem certeza que deseja deletar esta empresa?")) {
            try {
                await axios.delete(`http://localhost:8000/company/${id}`, {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });
                // Atualiza a lista de empresas após a exclusão
                setCompanies(companies.filter(company => company.id !== id));
                console.log('Empresa deletada com sucesso!');
            } catch (error) {
                console.error('Erro ao deletar empresa:', error);
            }
        }
    };

    return (
        <div>
            <Typography variant="h4" gutterBottom>
                Lista de Empresas
            </Typography>
            <Button variant="contained" component={Link} to="/create-company" style={{ marginBottom: '16px' }}>
                Criar Nova Empresa
            </Button>
            <TableContainer component={Paper}>
                <Table>
                    <TableHead>
                        <TableRow>
                            <TableCell>ID</TableCell>
                            <TableCell>Nome</TableCell>
                            <TableCell>Endereço</TableCell>
                            <TableCell>Cidade</TableCell>
                            <TableCell>Estado</TableCell>
                            <TableCell>Código Postal</TableCell>
                            <TableCell>País</TableCell>
                            <TableCell>Ações</TableCell>
                        </TableRow>
                    </TableHead>
                    <TableBody>
                        {companies.map((company) => (
                            <TableRow key={company.id}>
                                <TableCell>{company.id}</TableCell>
                                <TableCell>{company.name}</TableCell>
                                <TableCell>{company.address}</TableCell>
                                <TableCell>{company.city}</TableCell>
                                <TableCell>{company.state}</TableCell>
                                <TableCell>{company.zip_code}</TableCell>
                                <TableCell>{company.country}</TableCell>
                                <TableCell>
                                    <Button variant="outlined" component={Link} to={`/edit-company/${company.id}`}>
                                        Editar
                                    </Button>
                                    <Button 
                                        variant="outlined" 
                                        color="error" 
                                        style={{ marginLeft: '8px' }} 
                                        onClick={() => handleDelete(company.id)}
                                    >
                                        Deletar
                                    </Button>
                                </TableCell>
                            </TableRow>
                        ))}
                    </TableBody>
                </Table>
            </TableContainer>
        </div>
    );
};

export default CompanyList;
