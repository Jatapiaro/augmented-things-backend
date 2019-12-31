import React, { Component } from 'react';
import Card from '../../Components/ApplicationCard';
import { Dropdown, Table } from 'tabler-react';
import TYPES from './TypeTransformer';

import { toast } from 'react-toastify';

import Modal from 'react-bootstrap4-modal';

export default class Index extends Component {

    state = {
        types: [],
        modal: {
            visible: false,
            index: -1,
            type: {
                id: '',
                type: ''
            }
        }
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

    /**
     * Show the modal to delete the type
     * @param {*} index of the type in the array
     */
    showDeleteModal(index) {
        let modal = this.state.modal;
        modal.visible = true;
        modal.type = this.state.types[index];
        modal.type.type = TYPES[modal.type.type]? TYPES[modal.type.type] : modal.type.type;
        modal.index = index;
        this.setState({ modal: modal });
    }

    /**
     * Closes the delete modal
     */
    handleCancelDelete = () => {
        const modal = this.resetModalData();
        this.setState({ modal: modal });
    }

    /**
     * Reset all the data inside the modal
     */
    resetModalData = () => {
        let modal = this.state.modal;
        modal.visible = false;
        modal.type = {
            id: '',
            type: ''
        };
        modal.index = -1;
        return modal;
    }

    /**
     * Handle the clic on the confirm delete modal
     * then, it makes the request to delete the type
     */
    handleConfirmDelete = () => {
        let modal = this.state.modal;
        this.props.typeService.destroy(modal.type)
            .then(res => {
                let types = this.state.types;
                types.splice(modal.index, 1);
                this.setState({
                    types: types,
                    modal: this.resetModalData()
                });
                toast.success("¡Se elimino el tipo con éxito!");
            })
            .catch(err => {
                toast.error("¡Hubo un problema al eliminar el tipo! por favor intentalo nuevamente");
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
                                                        this.showDeleteModal(index)
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
                <Modal
                    visible={this.state.modal.visible}
                    onClickBackdrop={this.handleCancelDelete}>
                    <div className="modal-header">
                        <h5 className="modal-title">
                            ¿Estás seguro de eliminar este tipo?
                        </h5>
                    </div>
                    <div className="modal-body">
                        <p>
                            <strong>ID: </strong> {this.state.modal.type.id || ''}
                        </p>
                        <p>
                            <strong>Tipo: </strong> {this.state.modal.type.type || ''}
                        </p>
                    </div>
                    <div className="modal-footer">
                        <button
                            type="button"
                            className="btn btn-secondary"
                            onClick={this.handleCancelDelete}>
                            Cancelar
                        </button>
                        <button
                            type="button"
                            className="btn btn-danger"
                            onClick={this.handleConfirmDelete}>
                            Sí, eliminar.
                        </button>
                    </div>
                </Modal>
            </Card>
        );
    }

}
