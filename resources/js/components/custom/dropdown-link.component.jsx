import React, { useState } from 'react';

const DropdownLink = ({children}) => {
    const [show, setShow] = useState(false)
    return (
        <li className={`nav-item has-treeview ${show ? 'menu-open' : ''}`} >
            <a href="#" className={`nav-link ${show ? 'active' : ''}`} onClick={(event) => { event.preventDefault(); setShow(!show) }}>
                <i className="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Starter Pages
                    <i className="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul className="nav nav-treeview" style={{ display: show ? 'block' : 'none' }}>
                {children}
            </ul>
        </li>
    );
}
export default DropdownLink;
