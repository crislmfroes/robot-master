import _ from 'lodash';
import { Action, ActionEvent, InputType } from '@projectstorm/react-canvas-core';
import { DefaultNodeModel } from '@projectstorm/react-diagrams';

class CustomAddStateAction extends Action {
  constructor(menu, options = {}) {
    options = {
      keyCodes: [67],
      ...options
    };
    super({
      type: InputType.KEY_DOWN,
      fire: (e) => {
        e.event.preventDefault();
        //console.log(e.event.clientX);
        //console.log(e.event.type);
        if (options.keyCodes.indexOf(e.event.keyCode) !== -1) {
          menu.current.show();
        }
      }
    })
  }
}

export default CustomAddStateAction;
