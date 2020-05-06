import React from 'react';
import Auth from './components/routes/protected-route.component';
import { Route, Redirect, Switch } from 'react-router-dom';
import LoginPage from './pages/login.component';
import Guest from './components/routes/guest-route.component';
import Dashboard from './components/admin/dashboard.component';


export const Routes = (
    <Switch>
        <Auth exact path="/dashboard" component={Dashboard}/>
        <Route exact path="/" render={props => <Redirect to="/login" />} />
        <Guest exact path="/login" component={LoginPage} />
    </Switch>
);
