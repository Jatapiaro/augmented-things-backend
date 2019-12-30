import React, { Component } from 'react';
import Card from '../../Components/ApplicationCard';
import { Dropdown, Table } from 'tabler-react';

export default class Index extends Component {

    state = {
        places: []
    }

    constructor(props) {
        super(props);
        this.columns = [
            'ID', 'Nombre', 'Dueño', ''
        ];
    }

    componentWillMount() {
        this.props.placeService.index()
            .then(res => {
                this.setState({
                    places: res
                });
            })
            .catch(err => {
                console.log(err);
            });
    }

    render() {
        return (
            <Card title="Lugares" redirectLink="/admin/places/create">
                <Table>
                    <Table.Header>
                        {
                            this.columns.map((col, index) =>
                                <Table.ColHeader key={`place-header-${index}`}>
                                    {col}
                                </Table.ColHeader>
                            )
                        }
                    </Table.Header>
                    <Table.Body>
                        {
                            this.state.places.map((place, index) =>
                                <Table.Row key={`place-row-${index}`}>
                                    <Table.Col>
                                        {place.id}
                                    </Table.Col>
                                    <Table.Col>
                                        {place.name}
                                    </Table.Col>
                                    <Table.Col>
                                        {`${place.user.name} (${place.user.id})`}
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
                                                        () => this.props.history.push(`/admin/places/${place.id}/edit`)
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
