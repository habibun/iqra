import React ,{Component}from 'react';
import { createRoot } from 'react-dom/client';
import axios from 'axios';
import {CHAPTER_DETAILS} from '../../apis/Url';
import {formatUrl} from '../../utils/Locale';

class ChapterDetails extends Component {
    constructor(props) {
        super(props);
        this.state = { chapter: [], loading: true};
    }

    componentDidMount() {
        this.getChapter();
    }

    getChapter() {
        let chapter_details = CHAPTER_DETAILS.replace('ID', window.location.href.substring(window.location.href.lastIndexOf('/') + 1));
        axios.get(formatUrl(chapter_details)).then(response => {
            this.setState({ chapter: response.data, loading: false })
        })
    }

    render() {
        const loading = this.state.loading;
        return (
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className="row">
                            <h2 className="text-center">
                                <span>List of chapters</span>
                            </h2>
                        </div>
                        {loading ? (
                            <div className={'row text-center'}>
                                GGG
                                <span className="fa fa-spin fa-spinner fa-4x"></span>
                            </div>
                        ) : (
                            <div className={'row'}>
                                { this.state.chapter.map(verse =>
                                    <div className="flex my-3" key={verse.id}>
                                        <div className="block rounded-lg shadow-lg bg-white max-w-sm text-center">
                                            <div className="p-6">
                                                <h5 className="text-gray-900 text-xl font-medium mb-2">
                                                    {verse.text}
                                                </h5>
                                            </div>
                                            <div className="py-3 px-6 border-t border-gray-300 text-gray-600">
                                                {/*{user.name}*/}
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

const container = document.getElementById('chapter_details');
const root = createRoot(container);
root.render(<ChapterDetails/>);
