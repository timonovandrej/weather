import {Layout} from './layouts';
import {Info, Table} from './components';
import {ToastContainer} from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

export const App = () => {
    return (
        <Layout>
            <ToastContainer/>
            <Info/>
            <Table/>
        </Layout>
    );
};