import React, { Children } from "react";

const CustomButton = ({ className, children, type, text, ...otherProps}) => {
    return (
        <button
            type={`${type ? type : 'button'}`}
            className={`btn ${className}`}
            {...otherProps}
        >
            {children ? children : text }
        </button>
    );
}
export default CustomButton;
