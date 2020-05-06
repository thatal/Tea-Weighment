import React, { useState } from 'react';
import { withRouter } from 'react-router-dom';

const SidebarLink = ({link, icon, LinkName, match, ...rest}) => {
    const [isActive, setActive]  = useState(false);
    const handleClick = () => {
        setActive(!isActive);
    }
    console.log(rest);
    return (
        <li className="nav-item">
            <a href={`${link ? link : '#'}`} className={`nav-link ${match.path == link ? 'active' : ''}`} onClick={handleClick}>
                <i className={`far ${icon ? icon : 'fa-circle nav-icon'}`}></i>
                <p>{LinkName}</p>
            </a>
        </li>
    );
}

export default withRouter(SidebarLink);
