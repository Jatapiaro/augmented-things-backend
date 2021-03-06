import React, { Component } from 'react';
import { Form } from 'tabler-react';
import Card from '../../Components/ApplicationCard';
import Device from '../../Models/Device';
import DeviceForm from '../../Components/Forms/DeviceForm';

import { toast } from 'react-toastify';

export default class Edit extends Component {

    state = {
        device: new Device(),
        users: [],
        places: [],
        types: [],
        errors: {}
    }

    constructor(props) {
        super(props);
    }

    componentWillMount() {
        let id = this.props.match.params.id;
        Promise.all([
            this.props.userService.index(),
            this.props.typeService.index(),
            this.props.deviceService.show(id)
        ])
            .then((res) => {
                let users = res[0];
                let device = this.state.device;
                device.fillFromResponse(res[2]);
                console.log(device);
                let places = [];
                for (let i = 0; i < users.length; i++) {
                    let usr = users[i];
                    if (usr.id == device.user_id) {
                        device.user_id = i;
                        places = user.places;
                        console.log(places);
                        break;
                    }
                }
                this.setState({
                    users: users,
                    types: res[1],
                    device: device,
                    places: places
                });
            })
            .catch((err) => {
                toast.error('¡Ha ocurrido un error!');
                this.props.history.push('/admin/devices');
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
        let device = this.state.device;
        let index = device.user_id;
        device.user_id = (this.state.users[device.user_id]) ? this.state.users[device.user_id].id : '';
        this.props.deviceService.update(device, device.id)
            .then((res) => {
                this.props.history.push('/admin/devices');
                toast.success("¡Se agregó el lugar con éxito!");
            })
            .catch((err) => {
                device.user_id = index;
                toast.error('¡Hay errores en el formulario!');
                this.setState({
                    errors: err.errors,
                    device: device
                });
            });
    }

    /**
     * Handles the change of a value in the form
     *
     * @param event
     */
    onValueChange = (event) => {
        let device = this.state.device;
        device[event.target.name] = event.target.value;
        this.setState({
            device: device
        });
    }

    /**
     * Handles the value change of an user selection
     *
     * @param event
     */
    onUserChange = (event) => {
        let index = parseInt(event.target.value);
        let places = [];

        let user = '';
        let device = this.state.device;

        /**
         * If the passed index is not -1
         * grab the information
         */
        if (index !== -1) {
            user = this.state.users[index];
            places = user.places;
        }
        device.place_id = '';
        device.user_id = index;

        this.setState({
            places: places,
            device: device
        });

    }

    render() {
        return (
            <Form onSubmit={this.handleSubmit}>
                <Card title="Editar dispositivo" submit={true} formSubmitButtonText="Editar dispositivo">
                    <DeviceForm
                        device={this.state.device}
                        places={this.state.places}
                        types={this.state.types}
                        users={this.state.users}
                        getError={this.getError}
                        onValueChange={this.onValueChange}
                        onUserChange={this.onUserChange}
                        edit={true}
                    />
                </Card>
            </Form>
        );
    }

}
