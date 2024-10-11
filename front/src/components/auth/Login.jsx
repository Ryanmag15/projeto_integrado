import React, { useState } from 'react';
import { TextField, Button, Typography, Container, Box } from '@mui/material';
import useHttp from '../hooks/useHttp';
import { useNavigate } from 'react-router-dom'; 

function Login() {
    const { post, loading } = useHttp();
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState('');
    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError('');
        try {
            const response = await post('/auth/login', { email, password });
            console.log(response);
            localStorage.setItem('access-token', response.access_token);
            navigate('/home');
        } catch (error) {
            console.error(error);
            setError('Credenciais inválidas. Tente novamente.');
        }
    };

    return (
        <Container component="main" maxWidth="xs">
            <Box sx={{ marginTop: 8, display: 'flex', flexDirection: 'column', alignItems: 'center' }}>
                <Typography component="h1" variant="h5">Login</Typography>
                <Box component="form" onSubmit={handleSubmit} noValidate sx={{ mt: 1 }}>
                    <TextField
                        margin="normal"
                        required
                        fullWidth
                        id="email"
                        label="Email"
                        name="email"
                        autoComplete="email"
                        autoFocus
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                    />
                    <TextField
                        margin="normal"
                        required
                        fullWidth
                        name="password"
                        label="Senha"
                        type="password"
                        id="password"
                        autoComplete="current-password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                    />
                    {error && <Typography color="error" variant="body2">{error}</Typography>}
                    <Button type="submit" fullWidth variant="contained" sx={{ mt: 3, mb: 2 }} disabled={loading}>
                        {loading ? 'Entrando...' : 'Entrar'}
                    </Button>
                    <Button fullWidth variant="outlined" onClick={() => navigate('/register')}>
                        Não tem uma conta? Cadastre-se agora
                    </Button>
                </Box>
            </Box>
        </Container>
    );
}

export default Login;
