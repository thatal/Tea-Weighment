import React, { Children } from "react";

const CustomButton = ({ className, type, text, ...otherProps}) => {
    return (
        <button type={`${type ? type : 'button'}`} className={`btn ${className}`} {...otherProps}>{text}</button>
    );
}
export default CustomButton;
