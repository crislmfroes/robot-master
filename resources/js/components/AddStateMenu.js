import React from 'react';
import axios from 'axios';
//import { Modal, List, ListItem, ListItemText, TextField, Paper, Card } from '@material-ui/core';
import { Modal, ListGroup, ListGroupItem, FormText, Card } from 'react-bootstrap'
import { StateNodeModel } from '../diagrams/StateNodeModel';
import ROSLIB from 'roslib';

class AddStateMenu extends React.Component {

    constructor(props) {
        super(props)
        this.state = {
            open: false,
            rosStates: [],
            engine: undefined,
            position: {
                x: undefined,
                y: undefined
            }
        }
    }

    setPos(position) {
        this.setState({
            position: position
        });
    }

    componentDidMount() {
        this.setState({
            open: this.props.open,
            rosStates: [],
            engine: this.props.engine
        });
        this.fetchStates();
    }

    handleClose() {
        this.setState({
            open: false
        });
    }

    show() {
        this.setState({
            open: true
        });
    }

    handleClick(state, event) {
        console.log('click');
        const node = new StateNodeModel({
            name: state.name,
            color: 'rgb(0,192,255)',
            position: this.props.engine.getRelativeMousePoint({
                clientX: event.clientX,
                clientY: event.clientY,
            })
        });
        console.log('created node');
        const port_in = node.addInPort("Input");
        console.log('added input port to node');
        console.log(this.state.engine.getModel());
        this.state.engine.getModel().addNode(node);
        console.log('added node to engine')
        this.state.engine.getModel().addAll(port_in);
        console.log('added input port to engine');
        state.outcomes.forEach(outcome => {
            const port_outcome = node.addOutPort(outcome);
            console.log('added output port to node');
            this.state.engine.getModel().addAll(port_outcome);
            console.log('added output port to engine');
        });
        console.log('repainting canvas');
        this.state.engine.repaintCanvas();
        this.handleClose();
    }

    fetchStates() {
        const service = new ROSLIB.Service({
            ros: this.props.ros,
            name: '/discover_machines',
            messageType: 'std_msgs/Empty'
        });
        const request = new ROSLIB.ServiceRequest();
        service.callService(request, res => {
            const states = new ROSLIB.Param({
                ros: this.props.ros,
                name: '/butia_behavior/states'
            });
            console.log(states);
            states.get(statesValue => {
                console.log('states value');
                console.log(statesValue);
                statesValue.forEach(stateInfoValue => {
                  const state = stateInfoValue[0][0];
                  console.log(state);
                  this.state.rosStates.push({
                    name: state.class_name,
                    outcomes: state.outcomes
                  });
                });

            });

        });
        /*axios.get(`${process.env.REACT_APP_BACKEND_URL}/api/behavior/states`).then(res => {
          console.log(res);
          this.setState({
            rosStates: res.data
          });
        })*/
    }

    listState(state, index) {
        return (
            <ListGroupItem key={index} onClick={(e) => this.handleClick(state, e)} >
                {state.name}
            </ListGroupItem>
        )
    }

    render() {
        const open = this.state.open;
        const rosStates = this.state.rosStates;
        console.log(rosStates);
        console.log(open)
        return (
            <Modal
                show={open}
                onHide={this.handleClose}
            //aria-labelledby="select state from the list"
            //aria-describedby="select state from the list"
            >
                <Card style={
                    {
                        width: "50%",
                        position: "absolute",
                        margin: "25%"
                    }
                }>
                    <FormText id="name" label="State name"></FormText>
                    <ListGroup /*aria-label="states"*/>
                        {rosStates.map((s, i) => this.listState(s, i))}
                    </ListGroup>
                </Card>
            </Modal>
        )
    }
}

export default AddStateMenu;
