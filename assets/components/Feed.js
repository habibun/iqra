import React ,{Component}from 'react';
import ReactDom from 'react-dom';
import axios from 'axios';

class Feed extends Component {
    constructor(props) {
        super(props);
        this.state = { verse: [], loading: true};
    }

    componentDidMount() {
        this.getVerse();
    }

    getVerse() {
        axios.get(`https://dev.iqra.com/en/api/quran/api/chapter/verse/random`).then(verse => {
            console.log(verse);
            this.setState({ verse: verse.data, loading: false})
        })
    }

    render() {
        console.log(this.state);
        return <h2>Feed! <span> {this.state.verse.text} </span></h2>;
    }
}

ReactDom.render(<Feed/>, document.getElementById('root'));
