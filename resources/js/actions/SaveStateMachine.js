import React from 'react';
import _ from 'lodash';
import { Action, ActionEvent, InputType } from '@projectstorm/react-canvas-core';
import { DefaultNodeModel } from '@projectstorm/react-diagrams';

class SaveStateMachineAction extends Action {
  constructor(options = {}, callback = () => {}) {
    options = {
      keyCodes: [83],
      ...options
    };
    super({
      type: InputType.KEY_DOWN,
      fire: (e) => {
        e.event.preventDefault();
        if (options.keyCodes.indexOf(e.event.keyCode) !== -1 && e.event.ctrlKey === true) {
          callback();
        }
      }
    })
  }
}

export default SaveStateMachineAction;
