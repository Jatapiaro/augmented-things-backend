import React, { Component, Fragment } from 'react';
import ReactDOM from 'react-dom';
import Layout from './Components/Layout/Layout';

import { BrowserRouter, Route, Redirect, Switch } from 'react-router-dom';
import Home from './Pages/Home';

export default class ReactWrapper extends Component {

    render() {
        return (
            <Fragment>
                <Layout>
                    <BrowserRouter>
                        <div className="content">
                            <Switch>

                                <Route path="/admin"
                                    render={(props) =>
                                        <Home
                                            {...props}
                                        />
                                    }
                                    exact={true} />

                            </Switch>
                        </div>
                    </BrowserRouter>
                </Layout>
            </Fragment>
        );
    }

}

if (document.getElementById('app')) {
    ReactDOM.render(<ReactWrapper />, document.getElementById('app'));
}
