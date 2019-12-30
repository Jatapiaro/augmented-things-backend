import React, { Component } from 'react';
import { Form } from 'tabler-react';
import Card from '../../Components/ApplicationCard';
import Type from '../../Models/Type';
import TypeForm from '../../Components/Forms/TypeForm';

import { toast } from 'react-toastify';

export default class Index extends Component {

    state = {
        type: new Type(),
        errors: {}
    }

    constructor(props) {
        super(props);
    }

    /**
     * Return an error given a key
     * @param key or name of the error
     */
    getError = (key) => {
        let response = null;
        if (this.state.errors[key]) {
            response = this.state.errors[key].join();
        }
        return response;
    }

    /**
     * Handles the form submission
     *
     * @param event
     */
    handleSubmit = (event) => {
        event.preventDefault();
        this.props.typeService.store(this.state.type)
            .then((res) => {
                this.props.history.push('/admin/types');
                toast.success("¡Se agregó el prospecto con éxito!");
            })
            .catch((err) => {
                toast.error('¡Hay errores en el formulario!');
                this.setState({
                    errors: err.errors
                });
            });
    }

    /**
     * Handles the change of a value in the form
     *
     * @param event
     */
    onValueChange = (event) => {
        let type = this.state.type;
        type[event.target.name] = event.target.value;
        this.setState({
            type: type
        });
    }

    render() {
        return (
            <Form onSubmit={this.handleSubmit}>
                <Card title="Dispositivos Válidos" submit={true} formSubmitButtonText="Crear Tipo">
                    <TypeForm
                        type={this.state.type}
                        getError={this.getError}
                        onValueChange={this.onValueChange}
                    />
                </Card>
            </Form>
        );
    }

}
