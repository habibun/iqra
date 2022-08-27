import React ,{Component}from 'react';
import ReactDom from 'react-dom';
import axios from 'axios';
import {RANDOM_VERSE} from '../apis/Url';
import {formatUrl} from '../utils/Locale';

class Homepage extends Component {
    constructor(props) {
        super(props);
        this.state = { verse: [], loading: true};
    }

    componentDidMount() {
        this.getVerse();
    }

    getVerse() {
        axios.get(formatUrl(RANDOM_VERSE)).then(verse => {
            this.setState({ verse: verse.data, loading: false})
        })
    }

    render() {
        return <h2><span> {this.state.verse.text} </span></h2>;
    }
}

ReactDom.render(<Homepage/>, document.getElementById('homepage'));
