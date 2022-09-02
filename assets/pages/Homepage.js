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
        return (
            <p>
                <h1 className="text-3xl font-bold mb-8">
                    <span> {this.state.verse.text} </span>
                </h1>
                <hr className="my-6 border-gray-300"/>
                <span> {this.state.verse.chapter_name} - {this.state.verse.verse_key} </span>
            </p>
        );
    }
}

ReactDom.render(<Homepage/>, document.getElementById('homepage'));
