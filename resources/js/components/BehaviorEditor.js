import React from 'react';
import ReactDOM from 'react-dom';
import createEngine, {
  DefaultNodeModel,
  DiagramModel
} from '@projectstorm/react-diagrams';
import {
  CanvasWidget
} from '@projectstorm/react-canvas-core';
import CustomAddStateAction from '../actions/AddState';
import GenerateStateMachineAction from '../actions/GenerateStateMachine';
import SaveStateMachineAction from '../actions/SaveStateMachine';
import AddStateMenu from '../components/AddStateMenu';
import { connect } from 'react-redux';
import ROSLIB from 'roslib';
import store from '../store/store';
import { Provider } from 'react-redux';

const mapStateToProps = (state) => {
  console.log(state);
  return {
    diagram: state.diagram
  }
}

class BehaviorEditorComponent extends React.Component {


  constructor(props) {
    super(props);
    this.state = {
        menuOpen: false,
        engine: createEngine()
    }
    this.menu = React.createRef();
    const model = new DiagramModel();
    this.state.engine.setModel(model);
    this.ros = new ROSLIB.Ros();
  }

  generateMachine(model) {
      console.log(model.getNodes());
      console.log(model.getLinks());
  }

  componentDidMount() {
    this.ros.connect("ws://0.0.0.0:9090")
    this.ros.on('connection', e => {
      console.log(e);
    });
    const engine = this.state.engine;
    const model = engine.getModel();
    console.log(this.props);
    if (this.props.diagram) {
      model.deserializeModel(this.props.diagram, engine);
    } else {
      const node1 = new DefaultNodeModel({
        name: 'Node 1',
        color: 'rgb(0,192,255)'
      });
      node1.setPosition(100, 100);
      let port1 = node1.addOutPort('Out');
      const node2 = new DefaultNodeModel({
        name: 'Node 2',
        color: 'rgb(0,192,255)'
      });
      let port2 = node2.addInPort('In');
      node2.setPosition(400, 100);
      let link1 = port1.link(port2);
      link1.getOptions().testName = 'Test';
      link1.addLabel('Hello World!');
      model.addAll(node1, node2, link1);
    }
    model.registerListener({
      eventWillFire: () => this.props.dispatch({
        type: 'SAVE_GRAPH',
        diagram: model.serialize()
      })
    });
    engine.getActionEventBus().registerAction(new CustomAddStateAction(this.menu));
    engine.getActionEventBus().registerAction(new SaveStateMachineAction({}, () => {
      this.props.dispatch({
        type: 'SAVE_GRAPH',
        diagram: model.serialize()
      })
    }));
    engine.getActionEventBus().registerAction(new GenerateStateMachineAction({}, () => {
      this.generateMachine(model);
    }));
    this.setState({
      engine: engine
    });
  }

  render() {
    const engine = this.state.engine;
    const open = this.state.menuOpen;
    const ros = this.ros;
    return (
      <div >
        {true && <CanvasWidget engine={engine} className="canvas-widget" style={{
            width: 100,
            height: 100,
            overflow: 'visible'
        }} />}
        {engine.getModel() !== null && <AddStateMenu ref={this.menu} open={open} engine={engine} ros={ros}/>}
      </div>
    );
  }
}

const BehaviorEditorComponentRedux = connect(mapStateToProps)(BehaviorEditorComponent);
/*
for (const element in document.getElementsByClassName('behavior-editor')) {
    ReactDOM.render(<BehaviorEditorComponent />, element);
};*/
if (document.getElementById('behavior-editor')) {
    ReactDOM.render(<Provider store={store}>
        <BehaviorEditorComponentRedux />
    </Provider>, document.getElementById('behavior-editor'));
}
