import React, { useContext } from "react";
import { AuthContext } from "../../app";
import { Route, Redirect } from "react-router-dom";


function Auth({ component: Component, ...rest }) {
    const {state} = useContext(AuthContext);
    return (
        <Route
            {...rest}
            render={props =>
                state.user ? <Component {...props} /> : <Redirect to="/login" />
            }
        />
    );
}
export default Auth
