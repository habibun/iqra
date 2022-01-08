// import { createAction, createReducer } from '@reduxjs/toolkit'
//
// export const increment = createAction('increment/counter');
// export const decrement = createAction('decrement/counter');
// export const increaseByAmount = createAction('increaseByAmount/counter');
//
// // reducer
// //1.using builder notation
//
// const initialState = {
//     value: 0,
// }
//
// export const counterSlices = createReducer(initialState, builder => {
//     builder.addCase(increment, (state, action) => {
//         console.log(state.value);
//         state.value++;
//     });
//     builder.addCase(decrement, (state, action) => {
//         state.value++;
//     });
//     builder.addCase(increaseByAmount, (state, action) => {
//         state.value += action.payload;
//     });
//     }
// );