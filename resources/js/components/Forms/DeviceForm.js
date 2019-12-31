import React, { Component, Fragment } from 'react';
import { Form } from 'tabler-react';
import Device from '../../Models/Device';

import TYPES from './../../Pages/Types/TypeTransformer';

export default class DeviceForm extends Component {

    render() {
        return (
            <Fragment>

                <Form.Group
                    label="Nombre"
                    isRequired="true">
                    <Form.Input
                        name="name"
                        error={this.props.getError('device.name')}
                        value={this.props.device.name}
                        onChange={this.props.onValueChange}
                    />
                </Form.Group>

                <Form.Group
                    label="Latitude"
                    isRequired="true">
                    <Form.Input
                        name="latitude"
                        error={this.props.getError('device.latitude')}
                        value={this.props.device.latitude}
                        onChange={this.props.onValueChange}
                    />
                </Form.Group>

                <Form.Group
                    label="Longitud"
                    isRequired="true">
                    <Form.Input
                        name="longitude"
                        error={this.props.getError('device.longitude')}
                        value={this.props.device.longitude}
                        onChange={this.props.onValueChange}
                    />
                </Form.Group>

                <Form.Group
                    label="Altitude"
                    isRequired="true">
                    <Form.Input
                        name="altitude"
                        error={this.props.getError('device.altitude')}
                        value={this.props.device.altitude}
                        onChange={this.props.onValueChange}
                    />
                </Form.Group>

                <Form.Group label="Tipo" isRequired="true">
                    <Form.Select
                        name="type_id"
                        error={this.props.getError('device.type_id')}
                        value={this.props.device.type_id}
                        onChange={this.props.onValueChange}
                        disabled={this.props.edit}>
                        <option value="">Selecciona un tipo</option>
                        {
                            this.props.types.map((type, index) =>
                                (type.used === false || type.id == this.props.device.type_id) &&
                                <option key={`type-option-${index}`} value={type.id}>
                                    {
                                        TYPES[type.type]
                                        ? TYPES[type.type]
                                        : type.type
                                    }
                                    {
                                        ` - ${type.id}`
                                    }
                                </option>
                            )
                        }
                    </Form.Select>
                </Form.Group>

                <Form.Group label="Dueño" isRequired="true">
                    <Form.Select
                        name="user_id"
                        error={this.props.getError('device.user_id')}
                        value={this.props.device.user_id}
                        onChange={this.props.onUserChange}>
                        <option value="-1">Selecciona un usuario</option>
                        {
                            this.props.users.map((user, index) =>
                                <option key={`user-option-${index}`} value={index}> {`${user.name} (${user.id})`} </option>
                            )
                        }
                    </Form.Select>
                </Form.Group>

                <Form.Group label="Lugar" isRequired="true">
                    <Form.Select
                        name="place_id"
                        error={this.props.getError('device.place_id')}
                        value={this.props.device.place_id}
                        onChange={this.props.onValueChange}>
                        <option value="">Selecciona un lugar</option>
                        {
                            this.props.places.map((place, index) =>
                                <option key={`place-option-${index}`} value={place.id}> {`${place.name} (${place.id})`} </option>
                            )
                        }
                    </Form.Select>
                </Form.Group>

            </Fragment>
        );
    }

}

DeviceForm.defaultProps = {
    device: new Device(),
    edit: false,
    users: [],
    places: [],
    types: []
}
