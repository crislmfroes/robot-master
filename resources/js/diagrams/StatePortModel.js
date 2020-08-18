import { DefaultPortModel } from '@projectstorm/react-diagrams';


class StatePortModel extends DefaultPortModel {

    canLinkToPort(port) {
        if (port instanceof StatePortModel) {
            if (this.options.in) {
                return !(port.getOptions().in) && (port.getLinks().length == 0)
            } else {
                return (port.getOptions().in) && (this.getLinks().length== 0);
            }
        }
    }

}

export default StatePortModel;
