import {CurrencyType} from '../../types';

type ItemType = {
    item: CurrencyType
}

export const TableBodyItem = (props: ItemType) => {
    const {codeA, codeB, rateBuy, rateSell, rateCross, date} = props.item;

    return (
        <tr>
            <td>{date}</td>
            <td>{codeA}</td>
            <td>{codeB}</td>
            <td>{rateBuy}</td>
            <td>{rateSell}</td>
            <td>{rateCross}</td>
        </tr>
    )
}