import React, { Component } from 'react';

export default class Footer extends Component {

    render() {
        return (
            <footer className="footer">
                <div className="container">
                    <div className="row row align-items-center flex-row-reverse">
                        <div className="col col-auto ml-auto">
                            <div className="row row align-items-center">
                                <div className="col col-auto">
                                    <ul className="list list-inline list-inline-dots mb-0">
                                        <li className="list-inline-item">
                                            Developed by @Jatapiaro
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        );
    }

}
