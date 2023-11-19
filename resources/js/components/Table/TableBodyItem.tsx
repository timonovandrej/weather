import {WeatherType} from '../../types';

type ItemType = {
    item: WeatherType
}

export const TableBodyItem = (props: ItemType) => {
    const {maxTmp, minTmp, windSpd, date} = props.item;

    return (
        <tr>
            <td>{date}</td>
            <td>{maxTmp} &deg;C</td>
            <td>{minTmp} &deg;C</td>
            <td>{windSpd} km\h</td>
        </tr>
    )
}