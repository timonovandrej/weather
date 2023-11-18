import {Box, Button, TextField} from "@mui/material";

export const stylesBox = {
    display: 'flex',
    gap: '10px',
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
};

export const stylesInput = {
    display: 'flex',
    flexGrow: 1,
}

export const Search = () => {
    return (
        <Box sx={stylesBox}>
            <TextField variant='outlined' sx={stylesInput} />
            <Button variant='outlined' color='primary'>Get from api</Button>
            <Button variant='contained' color='primary'>Get from DB</Button>
        </Box>
    )
}