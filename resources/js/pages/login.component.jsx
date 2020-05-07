import React, { useState, useContext } from "react";
import { Link } from "react-router-dom";
import { AuthContext } from "../app";
import { setAuthUser } from "../reducers/user/user.action";
import { useFormik } from "formik";
import * as Yup from 'yup'; // for everything
import toastr from 'toastr';
import LoadingButton from "../components/custom/loading-button.component";

const LoginPage = () => {
    const { state, userDispatch} = useContext(AuthContext);
    const [ button_loading, setButtonLogin] = useState(false);
    const form_fields ={
        email: "",
        password: ""
    }
    const validationSchema = Yup.object({
        password: Yup.string().min(6, 'Too Short!').max(50, 'Too Long!').required('Required'),
        email: Yup.string().email('Invalid email').required('Required')
    });
    const formik = useFormik({
        initialValues: form_fields,
        onSubmit: (values) => {
            handleSignIn(values);
        },
        validationSchema
    });
    const handleSignIn = function(values) {
        setButtonLogin(true);
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.post("/api/admin/login", values)
                .then(response => {
                    formik.resetForm(form_fields);
                    setButtonLogin(false);
                    userDispatch(setAuthUser(response.data.data));
                })
                .catch(error => {
                    console.log(error);
                    toastr.error("Login failed.");
                    setButtonLogin(false);
                });
        }).catch(error => {
            console.log(error.response);
            setLoading(false);
        });

    }
    return (
        <div className="hold-transition login-page">
            <div className="login-box">
                <div className="login-logo">
                    <Link to="/">
                        <b>{process.env.MIX_APP_NAME}</b>
                    </Link>
                </div>
                <div className="card">
                    <div className="card-body login-card-body">
                        <form action="../../index3.html" method="post" onSubmit={formik.handleSubmit}>
                            <div className={`input-group mb-3`}>
                                <input id="email" name="email" type="email" className={`form-control ${formik.touched.email && formik.errors.email ? "is-invalid" : ""}`} placeholder="Email"
                                    onChange={formik.handleChange}
                                    value={formik.values.email}
                                    onBlur={formik.handleBlur}
                                />
                                <div className="input-group-append">
                                    <div className="input-group-text">
                                        <span className="fas fa-envelope"></span>
                                    </div>
                                </div>
                                {
                                formik.touched.email && formik.errors.email ? (<div className="invalid-feedback">{formik.errors.email}</div>) : null
                                }
                            </div>
                            <div className="input-group mb-3">
                                <input id="password" name="password" type="password" className={`form-control ${formik.touched.password && formik.errors.password ? "is-invalid" : ""}`} placeholder="Password"
                                    onChange={formik.handleChange}
                                    value={formik.values.password}
                                    onBlur={formik.handleBlur}
                                />
                                <div className="input-group-append">
                                    <div className="input-group-text">
                                        <span className="fas fa-lock"></span>
                                    </div>
                                </div>
                                {
                                    formik.touched.password && formik.errors.password ? (<div className="invalid-feedback">{formik.errors.password}</div>) : null
                                }
                            </div>
                            <div className="row">
                                <div className="col-8">
                                    <div className="icheck-primary">
                                        <input type="checkbox" id="remember" />
                                            <label htmlFor="remember">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <div className="col-4">
                                    <LoadingButton loading={button_loading} type="submit" className="btn-primary btn-block" text="Sign In"/>
                                    </div>
                            </div>
                        </form>
                        <div className="social-auth-links text-center mb-3">
                            <p>- OR -</p>
                            <a href="#" className="btn btn-block btn-primary">
                                <i className="fab fa-facebook mr-2"></i> Sign in using Facebook
                            </a>
                            <a href="#" className="btn btn-block btn-danger">
                                <i className="fab fa-google-plus mr-2"></i> Sign in using Google+
                            </a>
                        </div>
                        <p className="mb-1">
                            <a href="forgot-password.html">I forgot my password</a>
                        </p>
                        <p className="mb-0">
                            <a href="register.html" className="text-center">Register a new membership</a>
                        </p>
                    </div>
                </div>

            </div>

        </div>
    );
}
export default LoginPage;
