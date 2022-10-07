import React ,{Component}from 'react';
import { createRoot } from 'react-dom/client';
import axios from 'axios';
import {SIGN_DETAILS} from '../../apis/Url';
import {formatUrl} from '../../utils/Locale';

class SignDetails extends Component {
    constructor(props) {
        super(props);
        this.state = { sign: [], loading: true};
    }

    componentDidMount() {
        this.getSign();
    }

    getSign() {
        let sign_details = SIGN_DETAILS.replace('ID', window.location.href.substring(window.location.href.lastIndexOf('/') + 1));
        axios.get(formatUrl(sign_details)).then(response => {
            this.setState({ sign: response.data, loading: false })
        })
    }

    render() {
        const loading = this.state.loading;
        console.log(this.state.sign)
        return (
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className="row">
                            <h2 className="text-center">
                                <span>Details of sign</span>
                            </h2>
                        </div>
                        {loading ? (
                            <div className={'row text-center'}>
                                GGG
                                <span className="fa fa-spin fa-spinner fa-4x"></span>
                            </div>
                        ) : (
                            <div className={'row'}>
                                { this.state.sign.map(res =>
                                    <div className="flex my-3" key={res.id}>
                                        <div className="block rounded-lg shadow-lg bg-white max-w-sm text-center">
                                            <div className="p-6">
                                                <h5 className="text-gray-900 text-xl font-medium mb-2">
                                                    {res.title}
                                                </h5>
                                            </div>
                                            <div className="py-3 px-6 border-t border-gray-300 text-gray-600">
                                                {res.summary}
                                            </div>
                                        </div>
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                </section>
            </div>
        );
    }
}

const container = document.getElementById('sign_details');
const root = createRoot(container);
root.render(<SignDetails/>);
