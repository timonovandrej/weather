import {Layout} from './layouts';
import {Details, Search, Table} from './components';

export const App = () => {
    return (
        <Layout>
            <Search />
            <Details />
            <Table />
        </Layout>
    );
};