import React, { Component } from 'react';
import { Form } from 'tabler-react';
import Card from '../../Components/ApplicationCard';
import Place from '../../Models/Place';
import PlaceForm from '../../Components/Forms/PlaceForm';

import { toast } from 'react-toastify';

export default class Create extends Component {

    state = {
        place: new Place(),
        users: [],
        errors: {}
    }

    constructor(props) {
        super(props);
    }

    componentWillMount() {
        this.props.userService.index()
            .then((res) => {
                this.setState({
                    users: res
                });
            })
            .catch((err) => {
                toast.error('¡Ha ocurrido un error!');
                this.props.history.push('/admin/places');
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
        this.props.placeService.store(this.state.place)
            .then((res) => {
                this.props.history.push('/admin/places');
                toast.success("¡Se agregó el lugar con éxito!");
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
        let place = this.state.place;
        place[event.target.name] = event.target.value;
        this.setState({
            place: place
        });
    }

    render() {
        return (
            <Form onSubmit={this.handleSubmit}>
                <Card title="Crear lugar" submit={true} formSubmitButtonText="Crear lugar">
                    <PlaceForm
                        place={this.state.place}
                        users={this.state.users}
                        getError={this.getError}
                        onValueChange={this.onValueChange}
                    />
                </Card>
            </Form>
        );
    }

}
