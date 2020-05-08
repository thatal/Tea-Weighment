import React from "react";
import AdminNavbar from "./navbar-component";
import AdminSidebar from "./sidebar.component";
import AdminContent from "./content.component";
import AdminFooter from "./footer.component";
import Auth from "../routes/protected-route.component";
import { Switch, withRouter } from "react-router-dom";
import VehicleList from "./vehicle-master/vehicle-list.component";
import VehicleCreate from "./vehicle-master/vehicle-create.component";
import { CONST_ROUTES } from "../../routes";

const Dashboard = ({location}) => {
    // console.log(props);
    return (
        <div className="wrapper">
            <AdminNavbar />
            <AdminSidebar />
            <Switch>
                <Auth exact path="/admin/dashboard" component={() => <AdminContent title="Dashboard" />}/>
                <Auth exact path="/admin/vehicle" component={VehicleList}/>
                <Auth exact path={CONST_ROUTES.admin.vehicle_create} component={VehicleCreate}/>
            </Switch>
            <AdminFooter />
        </div>
    );
}
export default withRouter(Dashboard);
