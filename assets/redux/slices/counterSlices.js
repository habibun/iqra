import { createAction, createSlice, createAsyncThunk } from '@reduxjs/toolkit'
import axios from "axios";

// export const increment = createAction('increment/counter');
// export const decrement = createAction('decrement/counter');
// export const increaseByAmount = createAction('increaseByAmount/counter');

// reducer
//1.using builder notation

const initialState = {
    value: 0,
}

export const fetchPost = createAsyncThunk('get/post', async(payload,
                                                     {rejectWithValue,
                                                         getState, dispatch}) => {
    try {
        const {data} = await axios.get('https://jsonplaceholder.typicode.com/posts');

        return data;
    }catch (error) {
        return error?.response;
    }

});

export const counterSlices = createSlice({
    name: 'counter',
    initialState: initialState,
    reducers: {
        increment: (state, action) => {
            state.value++;
        },

        decrement: (state, action) => {
            state.value--;
        },

        increaseByAmount: (state, action) => {
            state.value += action.payload;
        },

    }
});

const postSlices = createSlice({
   name: 'post',
    initialState: {},
    extraReducers: {
       [fetchPost.pending]: (state, action) => {
           state.loading = true;
       },
       [fetchPost.fulfilled]: (state, action) => {
           state.postList = action.payload;
           state.loading = false;
       },
       [fetchPost.rejected]: (state, action) => {
           state.loading = false;
           state.error = action.payload;
       },
    }
});

export const {increment, decrement, increaseByAmount} = counterSlices.actions;
// export default counterSlices.reducer;
export default postSlices.reducer;