import React from 'react';
import { Link } from 'react-router-dom';
import DropdownLink from '../custom/dropdown-link.component';
import SidebarLink from '../custom/sidebar-link';
import mainLogo from 'admin-lte/dist/img/tea_logo.jpg';
import userImage from 'admin-lte/dist/img/man-dark-avatar.jpg';

const AdminSidebar = () => {
    return (
        <aside className="main-sidebar sidebar-dark-primary elevation-4">

            <a to="/dashboard" className="brand-link">
                <img src={mainLogo} alt={process.env.MIX_APP_NAME} className="brand-image img-circle elevation-3"
                    style={{ opacity: 0.8 }} />
                <span className="brand-text font-weight-light">{process.env.MIX_APP_NAME}</span>
            </a>

            {/* <!-- Sidebar --> */}
            <div className="sidebar">
                {/* <!-- Sidebar user panel (optional) --> */}
                <div className="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div className="image">
                        <img src={userImage} className="img-circle elevation-2" alt="User Image" />
                    </div>
                    <div className="info">
                        <a href="#" className="d-block">Alexander Pierce</a>
                    </div>
                </div>

                {/* <!-- Sidebar Menu --> */}
                <nav className="mt-2">
                    <ul className="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        {/* <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library --> */}
                        <SidebarLink LinkName="Dashboard" icon="fas fa-tachometer-alt" link="/admin/dashboard">
                            <span className="right badge badge-danger">New</span>
                        </SidebarLink>

                        <DropdownLink icon='fas fa-th'>
                            <SidebarLink LinkName="Active Page" />
                            <SidebarLink LinkName="InActive Page" />
                        </DropdownLink>
                    </ul>
                </nav>
                {/* <!-- /.sidebar-menu --> */}
            </div>
            {/* <!-- /.sidebar --> */}
        </aside>
    );
}
export default AdminSidebar;
