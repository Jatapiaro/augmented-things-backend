import React, { Component } from 'react';
import Header from './Header';
import Menu from './Menu';

import NavLink from '../../Models/NavLink';
import Footer from './Footer';

export default class Layout extends Component {

    state = {
        isCollapsedMenuOpen: false
    }

    constructor(props) {
        super(props);
        this.navlinks = [
            new NavLink(
                ' Tipos',
                'fa fa-object-group',
                '/types',
                true),
            new NavLink(
                ' Lugares',
                'fa fa-home',
                '/places',
                true),
            new NavLink(
                ' Dipositivos',
                'fa fa-tencent-weibo',
                '/devices',
                true),
        ];
    }

    toggleCollapsedMenu = () => {
        this.setState((prevState) => {
            return {
                isCollapsedMenuOpen: !prevState.isCollapsedMenuOpen
            }
        })
    }

    render() {
        return (
            <React.Fragment>
                <Header toggleCollapsedMenu={this.toggleCollapsedMenu}/>

                {
                    window.user.superuser === true &&
                    <Menu
                        isCollapsedMenuOpen={this.state.isCollapsedMenuOpen}
                        navlinks={this.navlinks}
                    />
                }

                {this.props.children}

                <Footer/>
            </React.Fragment>
        );
    }

}
