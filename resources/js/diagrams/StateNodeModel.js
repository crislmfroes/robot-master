import { DefaultNodeModel } from '@projectstorm/react-diagrams';
import StatePortModel from './StatePortModel';

class StateNodeModel extends DefaultNodeModel {

    constructor(options={}) {
        super({
            ...options,
            type: 'state-node'
        });
    }

    addInPort(name) {
        this.addPort(
            new StatePortModel({
                in: true,
                name: name
            })
        );
    }

    addOutPort(name) {
        this.addPort(
            new StatePortModel({
                in: false,
                name: name
            })
        );
    }

}

export default StateNodeModel;
