import React, { Component } from 'react';
import Card from '../../Components/ApplicationCard';
import { Dropdown, Table } from 'tabler-react';
import TYPES from './../Types/TypeTransformer';

import { toast } from 'react-toastify';

export default class Index extends Component {

    state = {
        devices: []
    }

    constructor(props) {
        super(props);
        this.columns = [
            'ID', 'Nombre', 'Tipo', 'Dueño', ''
        ];
    }

    componentWillMount() {
        this.props.deviceService.index()
            .then(res => {
                this.setState({
                    devices: res
                });
            })
            .catch(err => {
                toast.error('¡Ha ocurrido un error!');
                this.props.history.push('/admin');
            });
    }

    render() {
        return (
            <Card title="Dispositivos" redirectLink="/admin/devices/create">
                <Table>
                    <Table.Header>
                        {
                            this.columns.map((col, index) =>
                                <Table.ColHeader key={`device-header-${index}`}>
                                    {col}
                                </Table.ColHeader>
                            )
                        }
                    </Table.Header>
                    <Table.Body>
                        {
                            this.state.devices.map((device, index) =>
                                <Table.Row key={`device-row-${index}`}>
                                    <Table.Col>
                                        {device.id}
                                    </Table.Col>
                                    <Table.Col>
                                        {device.name}
                                    </Table.Col>
                                    <Table.Col>
                                        {
                                            TYPES[device.type.type]
                                            ? TYPES[device.type.type]
                                            : device.type.type
                                        }
                                    </Table.Col>
                                    <Table.Col>
                                        {`${device.user.name} (${device.user.id})`}
                                    </Table.Col>
                                    <Table.Col>
                                        <Dropdown
                                            type="button"
                                            color="primary"
                                            triggerContent="Acciones"
                                            items={[
                                                <Dropdown.Item
                                                    key={1}
                                                    onClick={
                                                        () => this.props.history.push(`/admin/devices/${place.id}/edit`)
                                                    }>
                                                    <i className="fa fa-pencil" />
                                                    <span> Editar</span>
                                                </Dropdown.Item>,
                                                <Dropdown.Item
                                                    key={2}
                                                    onClick={() =>
                                                        alert('Implement delete modal')
                                                    }>
                                                    <i className="fe fe-trash-2" />
                                                    <span> Borrar</span>
                                                </Dropdown.Item>
                                            ]}
                                        />
                                    </Table.Col>
                                </Table.Row>
                            )
                        }
                    </Table.Body>
                </Table>
            </Card>
        );
    }

}
