import React, { Component } from 'react';

import { Header } from 'tabler-react';

export default class Home extends Component {

    render() {
        return (
            <div>
                <Header.H1>Bienvenido: {window.user.name}</Header.H1>
                {
                    window.user.superuser === false &&
                    <p>
                        No tienes acceso de administrador. Por favor contacta al administrador del sitio para solicitar tu acceso.
                    </p>
                }
            </div>
        );
    }

}
