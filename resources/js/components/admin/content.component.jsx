import React from "react";

const AdminContent = ({title, children}) => {
    return (
        <div className="content-wrapper">
            {/* < !--Content Wrapper.Contains page content-- > */}
            {/* <!-- Content Header (Page header) --> */}
            <div className="content-header">
                <div className="container-fluid">
                    <div className="row mb-2">
                        <div className="col-sm-6">
                            <h1 className="m-0 text-dark">{title ? title : "Starter Page"}</h1>
                        </div>
                        {/* <!-- /.col --> */}
                        <div className="col-sm-6">
                            {/* <ol className="breadcrumb float-sm-right">
                                <li className="breadcrumb-item"><a href="#">Home</a></li>
                                <li className="breadcrumb-item active">Starter Page</li>
                            </ol> */}
                        </div>
                        {/* <!-- /.col --> */}
                    </div>
                    {/* <!-- /.row --> */}
                </div>
                {/* <!-- /.container-fluid --> */}
                {/* <!-- /.content-header --> */}
            </div>
            {children}
        </div>
    );
}

export default AdminContent;
