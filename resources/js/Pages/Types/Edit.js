import React, { Component } from 'react';
import { Form } from 'tabler-react';
import Card from '../../Components/ApplicationCard';
import Type from '../../Models/Type';
import TypeForm from '../../Components/Forms/TypeForm';

import { toast } from 'react-toastify';

export default class Edit extends Component {

    state = {
        type: new Type(),
        errors: {}
    }

    constructor(props) {
        super(props);
    }

    componentWillMount() {
        let id = this.props.match.params.id;
        this.props.typeService.show(id)
            .then((res) => {
                let type = this.state.type;
                type.fillFromResponse(res);
                this.setState({
                    type: type
                });
            })
            .catch((err) => {
                toast.error('¡Ha ocurrido un error! Inténtalo de nuevo')
            });
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
        this.props.typeService.update(this.state.type, this.state.type.id)
            .then((res) => {
                this.props.history.push('/admin/types');
                toast.success("¡Se ha actualizado el tipo con éxito!");
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

    /**
     * Handles the form switch change
     */
    onSwitchToggle = () => {
        let event = {
            target: {
                name: 'used',
                value: !this.state.type.used
            }
        };
        this.onValueChange(event);
    }

    render() {
        return (
            <Form onSubmit={this.handleSubmit}>
                <Card title="Editar dispositivo válido" submit={true} formSubmitButtonText="Editar tipo">
                    <TypeForm
                        type={this.state.type}
                        getError={this.getError}
                        onValueChange={this.onValueChange}
                        onSwitchToggle={this.onSwitchToggle}
                        edit={true}
                    />
                </Card>
            </Form>
        );
    }

}
