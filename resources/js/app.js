import React, { useState, createContext, useReducer, useEffect } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router} from 'react-router-dom';
import { Routes } from "./routes";
import { userReducer } from './reducers/user/user.reducer';
import Axios from 'axios';
import toastr from 'toastr';
import { setAuthUser } from './reducers/user/user.action';
// import axios from "axios";
export const AuthContext = createContext();
const App = () => {
    const INITIAL_STATE = {
        user: null
    }
    const [state, dispatch] = useReducer(userReducer, INITIAL_STATE);
    useEffect(() => {
        Axios.get('/sanctum/csrf-cookie').then(response => {
            Axios.get("/api/user").then(response => {
                // console.log(response);
                if(response.data){
                    dispatch(setAuthUser(response.data));
                }else{
                    toastr.error("Please Login.")
                }
            })
            .catch(error => {
                toastr.error("Authentication failed.")
            })
        }).catch(error => {
            console.log(error.response);
        });
    }, [])
    return (
        <AuthContext.Provider value={{state: state, userDispatch: dispatch}}>
            <Router>
                {Routes}
            </Router>
        </AuthContext.Provider>
    );
}

export default App;
if (document.getElementById('root')) {
    ReactDOM.render(<App />, document.getElementById('root'));
}
