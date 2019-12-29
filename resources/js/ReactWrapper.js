import React, { Component, Fragment } from 'react';
import ReactDOM from 'react-dom';
import Layout from './components/Layout/Layout';

export default class ReactWrapper extends Component {

    render() {
        return (
            <Fragment>
                <Layout>
                    <p>Perro mierda</p>
                </Layout>
            </Fragment>
        );
    }

}

if (document.getElementById('app')) {
    ReactDOM.render(<ReactWrapper />, document.getElementById('app'));
}
