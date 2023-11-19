import {Layout} from './layouts';
import {Details, Search, Table} from './components';
import {ToastContainer} from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

export const App = () => {
    return (
        <Layout>
            <ToastContainer/>
            <Search/>
            <Details/>
            <Table/>
        </Layout>
    );
};