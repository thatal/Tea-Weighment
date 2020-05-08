import React, { useEffect, useState } from 'react';
import AdminContent from '../content.component';
import Axios from 'axios';
import toastr from 'toastr';
import { withRouter } from 'react-router-dom';
import { CONST_ROUTES } from '../../../routes';
import LoadingButton from '../../custom/loading-button.component';
import { useFormik } from 'formik';
import * as Yup from 'yup';

const VehicleCreate = ({ history }) => {
    const initialValues = {
        name : "",
        weight : "",
    }
    const [loading, setLoadingButton] = useState(false);
    const validationSchema = Yup.object({
        name: Yup.string().min(2, 'Too Short!').max(100, 'Too Long!').required('Name is required'),
        weight: Yup.number().min(1).required('Weight is required')
    });
    const formik = useFormik({
        initialValues: initialValues,
        onSubmit: values => handleSubmit(values),
        validationSchema
    });
    const handleSubmit = (values) => {
        setLoadingButton(true);
        Axios.post("/api/admin/vehicle", values)
        .then(res => {
            toastr.success("Successfully added.");
            history.push(CONST_ROUTES.admin.vehicle_index);
        })
        .catch(error => {
            console.log(error.response);
            toastr.error("Whoops! something went wrong. Try again later.")
        })
        .finally(() => {
            setLoadingButton(false);
        });
    }
    return (
        <AdminContent title="Vehicles">
            <section className="content">
                <div className="card row">
                    <div className="card-header">
                        <h3 className="card-title">Vehicles New</h3>

                        <div className="card-tools">
                            <button type="button" className="btn btn-sm btn-outline-primary" title="Add New" onClick={() => { history.push(CONST_ROUTES.admin.vehicle_index) }}>
                                <i className="fas fa-list-alt"></i> View</button>
                        </div>
                    </div>
                    <form onSubmit={formik.handleSubmit}>
                        <div className="card-body col-sm-6">
                            <div className="form-group">
                                <label htmlFor="name">Vehicle Name : <strong className="text-danger text-center">*</strong></label>
                                <input type="text" className={`form-control ${formik.touched.name && formik.errors.name ? "is-invalid" : ""}`}
                                    id="name"
                                    name="name"
                                    placeholder="Vehicle Name"
                                    value={formik.values.name}
                                    onChange={formik.handleChange}
                                    onBlur={formik.handleBlur}
                                />
                                {
                                    formik.touched.name && formik.errors.name ? (<div className="invalid-feedback">{formik.errors.name}</div>) : null
                                }
                            </div>
                            <div className="form-group">
                                <label htmlFor="weight">Weight : <strong className="text-danger text-center">*</strong></label>
                                <input type="number" className={`form-control ${formik.touched.weight && formik.errors.weight ? "is-invalid" : ""}`}
                                    id="weight"
                                    name="weight"
                                    placeholder="Weight"
                                    value={formik.values.weight}
                                    onChange={formik.handleChange}
                                    onBlur={formik.handleBlur}
                                />
                                {
                                    formik.touched.weight && formik.errors.weight ? (<div className="invalid-feedback">{formik.errors.weight}</div>) : null
                                }
                            </div>
                        </div>

                        <div className="card-footer col-sm-6">
                            <LoadingButton loading={loading} type="submit" text="Submit" className="btn btn-success"></LoadingButton>
                        </div>
                    </form>
                </div>
            </section>
        </AdminContent>

    );
}
export default withRouter(VehicleCreate);
