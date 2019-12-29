import React, { Component } from 'react';

export default class Footer extends Component {

    render() {
        return (
            <footer class="footer">
                <div class="container">
                    <div class="row row align-items-center flex-row-reverse">
                        <div class="col col-auto ml-auto">
                            <div class="row row align-items-center">
                                <div class="col col-auto">
                                    <ul class="list list-inline list-inline-dots mb-0">
                                        <li class="list-inline-item">
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
