import {Layout} from './layouts';
import {Info, Table} from './components';
import {ToastContainer} from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import {useEffect} from 'react';
import {mount} from './actions';

export const App = () => {
    useEffect(() => {
        mount()
    }, []);

    return (
        <Layout>
            <ToastContainer/>
            <Info/>
            <Table/>
        </Layout>
    );
};