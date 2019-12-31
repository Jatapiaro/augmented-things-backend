import React, { Component, Fragment } from 'react';
import { Form } from 'tabler-react';
import Place from '../../Models/Place';

export default class PlaceForm extends Component {

    render() {
        return (
            <Fragment>

                <Form.Group
                    label="Nombre"
                    isRequired="true">
                    <Form.Input
                        name="name"
                        error={this.props.getError('place.name')}
                        value={this.props.place.name}
                        onChange={this.props.onValueChange}
                    />
                </Form.Group>

                <Form.Group
                    label="Latitude"
                    isRequired="true">
                    <Form.Input
                        name="latitude"
                        error={this.props.getError('place.latitude')}
                        value={this.props.place.latitude}
                        onChange={this.props.onValueChange}
                    />
                </Form.Group>

                <Form.Group
                    label="Longitud"
                    isRequired="true">
                    <Form.Input
                        name="longitude"
                        error={this.props.getError('place.longitude')}
                        value={this.props.place.longitude}
                        onChange={this.props.onValueChange}
                    />
                </Form.Group>

                <Form.Group
                    label="Altitude"
                    isRequired="true">
                    <Form.Input
                        name="altitude"
                        error={this.props.getError('place.altitude')}
                        value={this.props.place.altitude}
                        onChange={this.props.onValueChange}
                    />
                </Form.Group>

                <Form.Group label="Dueño" isRequired="true">
                    <Form.Select
                        name="user_id"
                        error={this.props.getError('place.user_id')}
                        value={this.props.place.user_id}
                        onChange={this.props.onValueChange}
                        disabled={this.props.edit}>
                        <option value="">Selecciona un usuario</option>
                        {
                            this.props.users.map((user, index) =>
                                <option key={index} value={user.id}> {`${user.name} (${user.id})`} </option>
                            )
                        }
                    </Form.Select>
                </Form.Group>

            </Fragment>
        );
    }

}

PlaceForm.defaultProps = {
    place: new Place(),
    edit: false
}
