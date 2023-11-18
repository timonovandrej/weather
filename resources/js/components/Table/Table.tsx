import {Box} from "@mui/material";

export const stylesBox = {
    display: 'flex',

    'table': {
        width: '100%',
        border: '1px solid #ccc',

        'th': {
            textAlign: 'left'
        },
        'td': {
            padding: '10px 0'
        }
    }
};

export const Table = () => {
    return (
        <Box sx={stylesBox}>
            <table>
                <thead>
                    <th>Date</th>
                    <th>Min temperature</th>
                    <th>Max temperature</th>
                    <th>Wind speed</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                </tbody>
            </table>
        </Box>
    )
}