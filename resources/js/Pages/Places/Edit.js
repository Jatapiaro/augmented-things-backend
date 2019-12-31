import React, { Component } from 'react';
import { Form } from 'tabler-react';
import Card from '../../Components/ApplicationCard';
import Place from '../../Models/Place';
import PlaceForm from '../../Components/Forms/PlaceForm';

import { toast } from 'react-toastify';

export default class Edit extends Component {

    state = {
        place: new Place(),
        users: [],
        errors: {}
    }

    constructor(props) {
        super(props);
    }

    componentWillMount() {
        let id = this.props.match.params.id;
        Promise.all([
            this.props.userService.index(),
            this.props.placeService.show(id)
        ])
        .then((res) => {
            let place = this.state.place;
            place.fillFromResponse(res[1]);
            this.setState({
                place: place,
                users: res[0]
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
        this.props.placeService.update(this.state.place, this.state.place.id)
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
                <Card title="Editar lugar" submit={true} formSubmitButtonText="Editar lugar">
                    <PlaceForm
                        place={this.state.place}
                        users={this.state.users}
                        getError={this.getError}
                        onValueChange={this.onValueChange}
                        edit={true}
                    />
                </Card>
            </Form>
        );
    }

}
