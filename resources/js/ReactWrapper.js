import React, { Component, Fragment } from 'react';
import ReactDOM from 'react-dom';
import Layout from './Components/Layout/Layout';

import { BrowserRouter, Route, Redirect, Switch } from 'react-router-dom';
import { ToastContainer } from 'react-toastify';

import Home from './Pages/Home';

/**
 * Types Components
 */
import TypesIndex from './Pages/Types/Index';
import TypesCreate from './Pages/Types/Create';


/**
 * Services
 */
import HttpService from './Services/HttpService';
import TypeService from './Services/TypeService';


export default class ReactWrapper extends Component {

    constructor(props) {
        super(props);
        this.httpService = new HttpService();
        this.typeService = new TypeService(this.httpService);
    }

    render() {
        return (
            <Fragment>
                <Layout>
                    <BrowserRouter>
                        <div className="container content">
                            <Switch>

                                <Route path="/admin"
                                    render={(props) =>
                                        <Home
                                            {...props}
                                        />
                                    }
                                    exact={true} />

                                {/* ============= Types =========== */}
                                <Route
                                    path="/admin/types"
                                    render={(props) => (
                                        window.user.superuser === true
                                            ? <TypesIndex
                                                typeService={this.typeService}
                                                {...props} />
                                            : <Redirect to='/admin' />
                                    )}
                                    exact={true} />

                                <Route
                                    path="/admin/types/create"
                                    render={(props) => (
                                        window.user.superuser === true
                                            ? <TypesCreate
                                                typeService={this.typeService}
                                                {...props} />
                                            : <Redirect to='/admin' />
                                    )}
                                    exact={true} />

                            </Switch>
                        </div>
                    </BrowserRouter>
                </Layout>
                <ToastContainer />
            </Fragment>
        );
    }

}

if (document.getElementById('app')) {
    ReactDOM.render(<ReactWrapper />, document.getElementById('app'));
}
