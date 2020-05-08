import React, { useEffect, useState, useContext } from 'react';
import AdminContent from '../content.component';
import Axios from 'axios';
import toastr from 'toastr';
import CustomButton from '../../custom/custom.button';
import { withRouter } from 'react-router-dom';
import { CONST_ROUTES } from '../../../routes';
import Pagination from '../../custom/pagination.component';
import { AuthContext } from '../../../app';
import { loggedOutUser } from '../../../reducers/user/user.action';

const VehicleList = ({ history }) => {
    const { userDispatch } = useContext(AuthContext);
    const [items, setItems] = useState([]);
    const [dataLoading, setLoading] = useState(true);
    useEffect(() => {
        LoadData();
    }, []);
    const LoadData = (page = 0) => {
        setLoading(true);
        const url = '/api/admin/vehicle';
        Axios.get("/api/admin/vehicle?page=2")
            .then(response => {
                console.log(response.data);
                setItems(response.data);
            })
            .catch(error => {
                if(error.response.status === 401){
                    toastr.error("Please login access.");
                    userDispatch(loggedOutUser());
                    return;
                }
                toastr.error("Whoops data fetching failed.");
            }).finally(() => {
                setLoading(false);
            });
    }
    const pageChangeHandler = (pageNo) => {
        console.log(pageNo);
    }
    const handleModal = (item) => {
        $("#exampleModal").modal();
    }
    return (
        <AdminContent title="Vehicle list">
            <section className="content">
                <div className="card">
                    <div className="card-header">
                        <h3 className="card-title">Vehicles</h3>

                        <div className="card-tools">
                            <button type="button" className="btn btn-sm btn-outline-primary" title="Add New" onClick={() => { history.push(CONST_ROUTES.admin.vehicle_create) }}>
                                <i className="fas fa-plus"></i> Add New</button>
                            <button type="button" className="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i className="fas fa-minus"></i></button>
                            <button type="button" className="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                <i className="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div className="card-body p-0">
                        <table className="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Weight</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                {
                                    items.data && items.data.length ?

                                        items.data.map((item, key) => (
                                            <tr key={key}>
                                                <td>{key + 1}</td>
                                                <td>{item.name}</td>
                                                <td>{item.weight}</td>
                                                <td>
                                                    <CustomButton text="Delete" type="button" className="btn-danger btn-sm" onClick={handleModal} />
                                                </td>

                                            </tr>
                                        ))

                                        :
                                        <tr>
                                            <td colSpan="4" className="text-danger text-center">No data found.</td>
                                        </tr>
                                }
                            </tbody>
                        </table>

                        {/* <div className="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div className="modal-dialog" role="document">
                                <div className="modal-content">
                                    <div className="modal-header">
                                        <h5 className="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div className="modal-body">
                                        ...
                                    </div>
                                    <div className="modal-footer">
                                        <button type="button" className="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" className="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div> */}
                    </div>
                    {
                        items.data && items.data.length ?
                            <Pagination items={[...Array(items.total)]} onChangePage={pageChangeHandler} initialPage={items.current_page} pageSize={items.per_page}/>
                            : null
                    }
                    {
                        dataLoading ?
                            <div className="overlay dark">
                                <i className="fas fa-circle-notch fa-spin"></i>
                            </div>
                            : null
                    }
                </div>
            </section>
        </AdminContent>

    );
}
export default withRouter(VehicleList);
