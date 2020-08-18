import React from 'react';
import ReactDOM from 'react-dom'

class MultiDictInput extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            fields: props.fields ? props.fields : [
                {
                    name: '',
                    value: ''
                }
            ]
        }
    }

    addField() {
        const $tmp = this.state.fields;
        $tmp.push({
            name: '',
            value: ''
        });
        this.setState({
            fields: $tmp
        });
    }

    removeField(index) {
        const $tmp = this.state.fields;
        $tmp.splice(index, 1);
        this.setState({
            fields: $tmp
        });
    }

    renderInput(field, index) {
        return (
            <div className="input-group mb-3">
                <div className="input-group-prepend">
                    <button type="button" className="btn btn-danger" onClick={() => this.removeField(index)} disabled={this.state.fields.length === 1}>-</button>
                </div>
                <input className="form-control" name={`${this.props.fieldName}[]`} type={"text"} defaultValue={field.name} key={index} />
                <span class="h5">=</span>
                <input className="form-control" name={`${this.props.fieldValue}[]`} type={"text"} defaultValue={field.value} key={index} />
                <input className="form-control" name={`${this.props.fieldName}_idx[]`} type={"hidden"} value={field.id} key={index} />
            </div>
        );
    }

    render() {
        return (
            <div className="form-group" >
                <label for={`${this.props.fieldName}[]`} className="m-2">{this.props.labelName}</label>
                {this.state.fields.map((field, index) => this.renderInput(field, index))}
                <button type="button" className="btn btn-success" onClick={() => this.addField()} >+</button>
            </div>
        );
    }

}

export default MultiDictInput;

if (document.getElementById('parameters-input')) {
    const stateParameters = JSON.parse(document.getElementById('parameters-input').getAttribute('parameters'));
    ReactDOM.render(<MultiDictInput fields={stateParameters} fieldName="parameter_keys" fieldValue="parameter_values" labelName="Input Parameters" />, document.getElementById('parameters-input'));
}
