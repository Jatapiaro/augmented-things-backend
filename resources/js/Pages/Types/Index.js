import React, { Component } from 'react';
import Card from '../../Components/ApplicationCard';
import { Dropdown, Table } from 'tabler-react';
import TYPES from './TypeTransformer';

import { toast } from 'react-toastify';

export default class Index extends Component {

    state = {
        types: []
    }

    constructor(props) {
        super(props);
        this.columns = [
            'ID', 'Tipo', 'Status', ''
        ];
    }

    componentWillMount() {
        this.props.typeService.index()
            .then(res => {
                this.setState({
                    types: res
                });
            })
            .catch(err => {
                toast.error('¡Ha ocurrido un error!');
                this.props.history.push('/admin');
            });
    }

    render() {
        return (
            <Card title="Dispositivos válidos" redirectLink="/admin/types/create">
                <Table>
                    <Table.Header>
                        {
                            this.columns.map((col, index) =>
                                <Table.ColHeader key={`type-header-${index}`}>
                                    {col}
                                </Table.ColHeader>
                            )
                        }
                    </Table.Header>
                    <Table.Body>
                        {
                            this.state.types.map((type, index) =>
                                <Table.Row key={`type-row-${index}`}>
                                    <Table.Col>
                                        {type.id}
                                    </Table.Col>
                                    <Table.Col>
                                        {
                                            TYPES[type.type]
                                            ? TYPES[type.type]
                                            : type.type
                                        }
                                    </Table.Col>
                                    <Table.Col>
                                        {type.used? 'Usado' : 'Disponible'}
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
                                                        () => this.props.history.push(`/admin/types/${type.id}/edit`)
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
