import {Box} from '@mui/material';
import {TableBodyItem, TableHeader} from '.';
import {EmptyData} from '..';
import {observer} from 'mobx-react-lite';
import {weatherStore} from '../../stores';
import {WeatherType} from '../../types';

const stylesBox = {
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

export const Table = observer(() => {
    const {items} = weatherStore;

    if (items.length === 0) {
        return <EmptyData />
    }

    return (
        <Box sx={stylesBox}>
            <table>
                <TableHeader />
                <tbody>
                {
                    items.map(
                        (item:WeatherType, i:number) => <TableBodyItem key={`item-key-${i}`} item={item} />
                    )
                }
                </tbody>
            </table>
        </Box>
    )
})