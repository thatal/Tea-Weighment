import React from 'react';
import Auth from './components/routes/protected-route.component';
import { Route, Redirect, Switch } from 'react-router-dom';
import LoginPage from './pages/login.component';


export const Routes = (
    <Switch>
        <Auth exact path="/app" />
        <Route exact path="/" render={props => <Redirect to="/login" />} />
        <Route exact path="/login" component={LoginPage} />
    </Switch>
);
