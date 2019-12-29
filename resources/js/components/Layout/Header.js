import React, { Component } from 'react';

export default class Header extends Component {

    logout = () => {
        alert('ok');
    }

    render() {
        return (
            <div className="omega-top-header">
                <div className="header py-4">
                    <div className="container">
                        <div className="d-flex">
                            <a className="header-brand" href="/">
                                Augmented Things Backend
                            </a>
                            <div className="d-flex order-lg-2 ml-auto">
                                <div className="dropdown">
                                    <a href="#" className="nav-link pr-0 leading-none" data-toggle="dropdown">
                                        <span className="profile">
                                            <div>
                                                <span className="text-default">Aquí va el final</span>
                                            </div>
                                        </span>
                                    </a>
                                    <div className="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a onClick={this.logout} className="dropdown-item" href="#">
                                            <i className="dropdown-icon fe fe-log-out"></i> Sign out
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <a onClick={this.props.toggleCollapsedMenu} className="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                                <span className="header-toggler-icon"></span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        )
    }

}
