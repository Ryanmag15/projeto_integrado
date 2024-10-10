import React from 'react';
import { Typography, Box } from '@mui/material';

const Home = () => {
    return (
        <Box sx={{ mt: 8, textAlign: 'center' }}>
            <Typography variant="h4" gutterBottom>
                Bem-vindo à sua aplicação!
            </Typography>
            <Typography variant="h6" gutterBottom>
                Explore nossas funcionalidades e comece sua jornada.
            </Typography>
        </Box>
    );
};

export default Home;
