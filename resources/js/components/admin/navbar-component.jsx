import React, { useContext } from 'react';
import CustomIcon from '../custom/spinner-icon.component';
import Axios from 'axios';
import { loggedOutUser } from '../../reducers/user/user.action';
import { AuthContext } from '../../app';
import toastr from "toastr";

const AdminNavbar = () => {
    const { userDispatch } = useContext(AuthContext);
    const logOutHandler = (event) => {
        event.preventDefault();
        Axios.post("/api/admin/logout")
            .then(response => {
                userDispatch(loggedOutUser())
                toastr.success("user logged out");
            })
            .catch(error => {
                toastr.error("Whoops something went wrong.")
            })
    }
    return (
        <nav className="main-header navbar navbar-expand navbar-white navbar-light">
            {/* <!-- Left navbar links --> */}
            <ul className="navbar-nav">
                <li className="nav-item">
                    <a className="nav-link" data-widget="pushmenu" href="#" role="button"><i className="fas fa-bars"></i></a>
                </li>
                <li className="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" className="nav-link">Home</a>
                </li>
                <li className="nav-item d-none d-sm-inline-block">
                    <a href="#" className="nav-link">Contact</a>
                </li>
            </ul>

            {/* <!-- SEARCH FORM --> */}
            <form className="form-inline ml-3">
                <div className="input-group input-group-sm">
                    <input className="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" />
                    <div className="input-group-append">
                        <button className="btn btn-navbar" type="submit">
                            <i className="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            {/* <!-- Right navbar links --> */}
            <ul className="navbar-nav ml-auto">
                {/* <!-- Messages Dropdown Menu --> */}
                <li className="nav-item">
                    <a className="nav-link" onClick={logOutHandler} href="">
                        <CustomIcon icon="fas fa-sign-out-alt" /> Logout
                    </a>
                </li>
            </ul>
            {/* <!-- /.navbar --> */}
        </nav>
    );
}
export default AdminNavbar;
