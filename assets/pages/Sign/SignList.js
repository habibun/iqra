import React ,{Component}from 'react';
import { createRoot } from 'react-dom/client';
import axios from 'axios';
import {SIGN_LIST, WEB_SIGN_DETAILS} from '../../apis/Url';
import {formatUrl} from '../../utils/Locale';

class ChapterList extends Component {
    constructor(props) {
        super(props);
        this.state = { signs: [], loading: true};
    }

    componentDidMount() {
        this.getVerse();
    }

    getVerse() {
        axios.get(formatUrl(SIGN_LIST)).then(signs => {
            this.setState({ signs: signs.data, loading: false})
        })
    }

    render() {
        const loading = this.state.loading;
        let signDetails = formatUrl(WEB_SIGN_DETAILS);
        console.log(this.state.signs);
        return(
        <div>
            <section className="row-section">
                <div className="container">
                    {loading ? (
                        <div className={'row text-center'}>
                            <span className="fa fa-spin fa-spinner fa-4x"></span>
                        </div>
                    ) : (
                        <div className={'row'}>
                            { this.state.signs.map(res =>
                                <a href={signDetails.replace('ID', res.sign.id.uuid)} key={res.sign.id.uuid}>
                                    <div className="flex my-3" >
                                        <div className="block rounded-lg shadow-lg bg-white max-w-sm text-center">
                                            <div className="p-6">
                                                <h5 className="text-gray-900 text-xl font-medium mb-2">
                                                    {res.name}
                                                </h5>
                                            </div>
                                            <div className="py-3 px-6 border-t border-gray-300 text-gray-600">
                                                {res.name}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            )}
                        </div>
                    )}
                </div>
            </section>
        </div>
        )
    }
}

const container = document.getElementById('sign_list');
const root = createRoot(container);
root.render(<ChapterList/>);
