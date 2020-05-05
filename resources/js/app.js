import React, { useState, createContext } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router, Switch, Route, Redirect } from 'react-router-dom';
import { Routes } from "./routes";
export const AuthContext = createContext();
const App = () => {
    const [state, setState] = useState({
        user: null
    });
    return (
        <AuthContext.Provider value={{state: state}}>
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
