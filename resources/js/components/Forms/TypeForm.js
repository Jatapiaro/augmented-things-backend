import React, { Component, Fragment } from 'react';
import { Form } from 'tabler-react';
import Type from '../../Models/Type';
import TYPES from './../../Pages/Types/TypeTransformer';

export default class TypeForm extends Component {

    render() {
        return (
            <Fragment>

                <Form.Group
                    label="ID"
                    isRequired="true">
                    <Form.Input
                        name="id"
                        error={this.props.getError('type.id')}
                        value={this.props.type.id}
                        onChange={this.props.onValueChange}
                        disabled={this.props.edit}
                    />
                </Form.Group>

                <Form.Group label="Tipo" isRequired="true">
                    <Form.Select
                        name="type"
                        error={this.props.getError('type.type')}
                        value={this.props.type.type}
                        onChange={this.props.onValueChange}>
                        <option value="">Selecciona un tipo</option>
                        {
                            Object.keys(TYPES).map(key =>
                                <option key={key} value={key}> {TYPES[key]} </option>
                            )
                        }
                    </Form.Select>
                </Form.Group>

                {
                    this.props.edit === true &&
                    <Form.Group label="Disponibilidad">
                        <Form.Switch
                            label={this.props.type.used? `Ocupado` : `Disponible`}
                            name="used"
                            checked={!this.props.type.used}
                            onChange={this.props.onSwitchToggle}
                        />
                    </Form.Group>
                }

            </Fragment>
        );
    }

}

TypeForm.defaultProps = {
    type: new Type(),
    edit: false
}
