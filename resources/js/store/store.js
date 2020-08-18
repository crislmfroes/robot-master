import { createStore } from 'redux';

function reducer(state = { }, action) {
  switch (action.type) {
    case 'SAVE_GRAPH':
      return {
        ...state,
        diagram: action.diagram,
      }
    default:
      return state;
  }
}

let store = createStore(reducer);

export default store;