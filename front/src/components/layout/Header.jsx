import React from 'react';
import { AppBar, Toolbar, Typography, Button, Box } from '@mui/material';
import { Link } from 'react-router-dom';

const Header = () => {
    return (
        <AppBar position="static" sx={{ width: '100%' }}>
            <Toolbar sx={{ justifyContent: 'space-between' }}>
                <Typography variant="h6" sx={{ flexGrow: 1, color: 'white' }}>
                    CRM
                </Typography>
                <Box>
                    <Button color="inherit" component={Link} to="/home" sx={{ mx: 1 }}>
                        Início
                    </Button>
                    <Button color="inherit" component={Link} to="/companies" sx={{ mx: 1 }}>
                        Empresas
                    </Button>
                </Box>
            </Toolbar>
        </AppBar>
    );
};

export default Header;
