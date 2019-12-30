import React, { Component, Fragment } from 'react';
import ReactDOM from 'react-dom';
import Layout from './Components/Layout/Layout';

import { BrowserRouter, Route, Redirect, Switch } from 'react-router-dom';
import { ToastContainer } from 'react-toastify';

import Home from './Pages/Home';

/**
 * Places Components
 */
import PlacesIndex from './Pages/Places/Index';
import PlacesCreate from './Pages/Places/Create';
import PlacesEdit from './Pages/Places/Edit';

/**
 * Types Components
 */
import TypesIndex from './Pages/Types/Index';
import TypesCreate from './Pages/Types/Create';
import TypesEdit from './Pages/Types/Edit';


/**
 * Services
 */
import HttpService from './Services/HttpService';
import TypeService from './Services/TypeService';
import PlaceService from './Services/PlaceService';
import UserService from './Services/UserService';


export default class ReactWrapper extends Component {

    constructor(props) {
        super(props);
        this.httpService = new HttpService();
        this.typeService = new TypeService(this.httpService);
        this.placeService = new PlaceService(this.httpService);
        this.userService = new UserService(this.httpService);
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

                                {/* ============= Places =========== */}
                                <Route
                                    path="/admin/places"
                                    render={(props) => (
                                        window.user.superuser === true
                                        ? <PlacesIndex
                                            placeService={this.placeService}
                                            {...props} />
                                        : <Redirect to='/admin' />
                                    )}
                                    exact={true} />

                                <Route
                                    path="/admin/places/create"
                                    render={(props) => (
                                        window.user.superuser === true
                                        ? <PlacesCreate
                                            placeService={this.placeService}
                                            userService={this.userService}
                                            {...props} />
                                        : <Redirect to='/admin' />
                                    )}
                                    exact={true} />

                                <Route
                                    path="/admin/places/:id/edit"
                                    render={(props) => (
                                        window.user.superuser === true
                                            ? <PlacesEdit
                                                placeService={this.placeService}
                                                userService={this.userService}
                                                {...props} />
                                            : <Redirect to='/admin' />
                                    )}
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

                                <Route
                                    path="/admin/types/:id/edit"
                                    render={(props) => (
                                        window.user.superuser === true
                                        ? <TypesEdit
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
