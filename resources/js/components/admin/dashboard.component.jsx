import React from "react";
import AdminNavbar from "./navbar-component";
import AdminSidebar from "./sidebar.component";
import AdminContent from "./content.component";
import AdminFooter from "./footer.component";

const Dashboard = () => {
    return (
        <div className="wrapper">
            <AdminNavbar />
            <AdminSidebar />
                <AdminContent title="Dashboard">

                </AdminContent>
            <AdminFooter />
        </div>
    );
}
export default Dashboard;
