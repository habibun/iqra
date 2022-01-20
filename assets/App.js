
import {Provider, useDispatch, useSelector} from 'react-redux';
import store from "./redux/store/store";
import {decrement, increaseByAmount, increment, fetchPost} from "./redux/slices/counterSlices";
import React, {useEffect} from 'react';


export default function App()
{
    const dispatch = useDispatch();
    const counter = useSelector(state => state?.counter)

    useEffect(() => {
        dispatch(fetchPost());
    }, []);

    const post = useSelector(state => state?.post)
    const {postList, loading} = post;
    console.log('counter', counter);
    console.log('post', post);
    console.log('postList', postList);
    return (
        <div className='bg-gray-100'>
            <div className="md:container md:mx-auto bg-white">
            <h1>Redux toolkit</h1>

            <h5>counter: {counter?.value}</h5>

            <p>
                <button onClick={() => dispatch(increment())}> + </button>
            </p>
            <p>

                <button onClick={() => dispatch(decrement())}> - </button>
            </p>
            <p>
                <button onClick={() => dispatch(increaseByAmount(20))}>Increase Amount</button>
            </p>
            <hr/>
            <hr/>
            <hr/>

            <h1>Post list</h1>
            <hr/>
            {loading ? <h2>Loading...</h2> : postList?.map(post => (
                <div>
                    <hr/>
                    <h2 className='font-bold'>{post?.title}</h2>
                    <p>{post?.body}</p>
                </div>
            ))}

        </div>
        </div>
    );
}