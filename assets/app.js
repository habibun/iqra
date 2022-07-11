/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import './styles/tailwind.css';

// start the Stimulus application
import './bootstrap';

import React ,{Component}from 'react';
import ReactDom from 'react-dom';

class App extends Component {
    render() {
        return <h2>Lift History! <span> test </span></h2>;
    }
}

ReactDom.render(<App/>, document.getElementById('root'));
