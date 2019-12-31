import React, { Component } from 'react';
import Card from '../../Components/ApplicationCard';
import { Dropdown, Table } from 'tabler-react';
import TYPES from './../Types/TypeTransformer';

import { toast } from 'react-toastify';

import Modal from 'react-bootstrap4-modal';

export default class Index extends Component {

    state = {
        devices: [],
        modal: {
            visible: false,
            index: -1,
            device: {
                id: '',
                name: '',
                user: ''
            }
        }
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

    /**
     * Show the modal to delete the type
     * @param {*} index of the type in the array
     */
    showDeleteModal(index) {
        let modal = this.state.modal;
        modal.visible = true;
        modal.device = this.state.devices[index];
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
        modal.device = {
            id: '',
            name: '',
            user: ''
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
        this.props.deviceService.destroy(modal.device)
            .then(res => {
                let devices = this.state.devices;
                devices.splice(modal.index, 1);
                this.setState({
                    devices: devices,
                    modal: this.resetModalData()
                });
                toast.success("¡Se elimino el dispositivo con éxito!");
            })
            .catch(err => {
                toast.error("¡Hubo un problema al eliminar el dispositivo! por favor intentalo nuevamente");
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
                                                        () => this.props.history.push(`/admin/devices/${device.id}/edit`)
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
                            ¿Estás seguro de eliminar este dispositivo?
                        </h5>
                    </div>
                    <div className="modal-body">
                        <p>
                            <strong>ID: </strong> {this.state.modal.device.id || ''}
                        </p>
                        <p>
                            <strong>Nombre: </strong> {this.state.modal.device.name || ''}
                        </p>
                        <p>
                            <strong>Dueño: </strong> {`${this.state.modal.device.user.name} (${this.state.modal.device.user.id})`}
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
