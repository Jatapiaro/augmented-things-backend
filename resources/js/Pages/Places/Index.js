import React, { Component } from 'react';
import Card from '../../Components/ApplicationCard';
import { Dropdown, Table } from 'tabler-react';

import { toast } from 'react-toastify';

import Modal from 'react-bootstrap4-modal';

export default class Index extends Component {

    state = {
        places: [],
        modal: {
            visible: false,
            index: -1,
            place: {
                id: '',
                name: '',
                user: ''
            }
        }
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
        modal.place = this.state.places[index];
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
        this.props.placeService.destroy(modal.place)
            .then(res => {
                let places = this.state.places;
                places.splice(modal.index, 1);
                this.setState({
                    places: places,
                    modal: this.resetModalData()
                });
                toast.success("¡Se elimino el lugar con éxito!");
            })
            .catch(err => {
                toast.error("¡Hubo un problema al eliminar el lugar! por favor intentalo nuevamente");
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
                            ¿Estás seguro de eliminar este lugar?
                        </h5>
                    </div>
                    <div className="modal-body">
                        <p>
                            <strong>ID: </strong> {this.state.modal.place.id || ''}
                        </p>
                        <p>
                            <strong>Nombre: </strong> {this.state.modal.place.name || ''}
                        </p>
                        <p>
                            <strong>Dueño: </strong> {`${this.state.modal.place.user.name} (${this.state.modal.place.user.id})`}
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
