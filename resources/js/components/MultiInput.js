import React from 'react';
import ReactDOM from 'react-dom'

class MultiInput extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            fields: props.fields ? props.fields : [
                {
                    'name': ''
                }
            ]
        }
    }

    addField() {
        const $tmp = this.state.fields;
        $tmp.push({
            name: ''
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

export default MultiInput;

if (document.getElementById('outcome-input')) {
    const outcomes = JSON.parse(document.getElementById('outcome-input').getAttribute('outcomes'));
    ReactDOM.render(<MultiInput fields={outcomes} fieldName="outcomes" labelName="Outcomes" />, document.getElementById('outcome-input'));
}

if (document.getElementById('in-keys-input')) {
    const inKeys = JSON.parse(document.getElementById('in-keys-input').getAttribute('keys'));
    ReactDOM.render(<MultiInput fields={inKeys} fieldName="input_keys" labelName="Input Keys" />, document.getElementById('in-keys-input'));
}

if (document.getElementById('out-keys-input')) {
    const outKeys = JSON.parse(document.getElementById('out-keys-input').getAttribute('keys'));
    ReactDOM.render(<MultiInput fields={outKeys} fieldName="output_keys" labelName="Output Keys" />, document.getElementById('out-keys-input'));
}
