import React from "react";

const AdminFooter = () => {
    return (
        <footer className="main-footer">
            {/* <!-- To the right --> */}
            <div className="float-right d-none d-sm-inline">
                Anything you want
            </div>
            {/* <!-- Default to the left --> */}
            <strong>Copyright &copy; 2014-2019 <a href="https://webcomindia.biz" target="_blank">Web.com India pvt. ltd.</a>.</strong> All rights reserved.
            <script src="/js/adminlte.js" defer></script>
        </footer>
    );
}
export default AdminFooter;
