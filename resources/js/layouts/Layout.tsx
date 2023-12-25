import {Box, Container} from '@mui/material';
import React from 'react';

type Props = {
    children: React.ReactNode;
}

const stylesContent = {
    flexDirection: 'column',
    alignItems: 'center',
    justifyContent: 'center',
}

export const Layout = ({children}: Props) => {
    return (
        <Container maxWidth='md'>
            <h1>Simple application</h1>

            <Box sx={stylesContent}>
                {children}
            </Box>
        </Container>
    )
}
