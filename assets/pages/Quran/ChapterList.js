import React ,{Component}from 'react';
import ReactDom from 'react-dom';
import axios from 'axios';
import {CHAPTER_DETAILS, CHAPTER_LIST, WEB_CHAPTER_DETAILS} from '../../apis/Url';
import {formatUrl} from '../../utils/Locale';

class ChapterList extends Component {
    constructor(props) {
        super(props);
        this.state = { chapters: [], loading: true};
    }

    componentDidMount() {
        this.getVerse();
    }

    getVerse() {
        axios.get(formatUrl(CHAPTER_LIST)).then(chapters => {
            this.setState({ chapters: chapters.data, loading: false})
        })
    }

    render() {
        const loading = this.state.loading;
        let chapterDetails = formatUrl(WEB_CHAPTER_DETAILS);
        return(
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
                            <span className="fa fa-spin fa-spinner fa-4x"></span>
                        </div>
                    ) : (
                        <div className={'row'}>
                            { this.state.chapters.map(user =>
                                <a href={chapterDetails.replace('ID', user.chapter.identifier)} key={user.chapter.identifier}>
                                    <div className="flex my-3" >
                                        <div className="block rounded-lg shadow-lg bg-white max-w-sm text-center">
                                            <div className="p-6">
                                                <h5 className="text-gray-900 text-xl font-medium mb-2">
                                                    {user.chapter.name_simple}
                                                </h5>
                                            </div>
                                            <div className="py-3 px-6 border-t border-gray-300 text-gray-600">
                                                {user.name}
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

ReactDom.render(<ChapterList/>, document.getElementById('chapter_list'));
