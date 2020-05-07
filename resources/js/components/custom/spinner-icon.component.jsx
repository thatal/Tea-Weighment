import React from 'react';

const CustomIcon = ({icon}) => {
    return (
        <i className={`fas ${icon ? icon : 'fa-circle-notch fa-spin'}`}></i>
    );
}
export default CustomIcon;
