import React ,{Component}from 'react';
import ReactDom from 'react-dom';

class Feed extends Component {
    render() {
        return <h2>Feed! <span> test </span></h2>;
    }
}

ReactDom.render(<Feed/>, document.getElementById('root'));
