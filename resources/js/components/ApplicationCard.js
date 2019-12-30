import React, { Component } from 'react';
import { Button, Card } from 'tabler-react';
import { withRouter } from 'react-router-dom';

class ApplicationCard extends Component {

    /**
     * Handles the cancel (buton) operation
     */
    handleCancel = () => {
        this.props.history.goBack();
    }

    /**
     * Handles the redirect button action
     */
    redirectTo = () => {
        this.props.history.push(this.props.redirectLink);
    }

    /**
     * Renders the component
     */
    render() {
        return (
            <Card>

                {/* Card Header */}
                <Card.Header>
                    <Card.Title>{this.props.title}</Card.Title>
                    <Card.Options>
                        {
                            this.props.submit === false &&
                            <Button.List>
                                {
                                    this.props.redirectLink &&
                                    <Button onClick={this.redirectTo}
                                        color="primary"
                                        icon="plus"
                                        size="sm">
                                        Agregar
                                    </Button>
                                }
                            </Button.List>
                        }
                    </Card.Options>
                </Card.Header>
                {/* ./Card Header */}

                <Card.Body>
                    {this.props.children}
                </Card.Body>

                <Card.Footer>
                    {
                        this.props.submit === true &&
                        <div className="d-flex">
                            <Button
                                type="button"
                                link
                                onClick={this.handleCancel}>
                                Cancelar
                            </Button>
                            <Button
                                type="submit"
                                color="primary"
                                className="ml-auto">
                                {this.props.formSubmitButtonText}
                            </Button>
                        </div>
                    }
                </Card.Footer>

            </Card>
        );
    }

}

ApplicationCard.defaultProps = {
    "formSubmitButtonText": 'Crear',
    "redirectLink": undefined,
    "submit": false,
    "title": '',
}

export default withRouter(ApplicationCard);
