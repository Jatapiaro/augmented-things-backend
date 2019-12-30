import React, { Component } from 'react';
import Card from '../../Components/ApplicationCard';
import { Table } from 'tabler-react';
import TYPES from './TypeTransformer';

export default class Index extends Component {

    state = {
        types: []
    }

    constructor(props) {
        super(props);
        this.columns = [
            'ID', 'Tipo', ''
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
                console.log(err);
            });
    }

    render() {
        return (
            <Card title="Dispositivos Válidos" redirectLink="/admin/types/create">
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
                                </Table.Row>
                            )
                        }
                    </Table.Body>
                </Table>
            </Card>
        );
    }

}
