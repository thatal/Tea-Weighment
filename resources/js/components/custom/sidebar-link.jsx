import React, { useState } from 'react';
import { withRouter } from 'react-router-dom';

const SidebarLink = ({link, icon, LinkName, children, match, history, ...rest}) => {
    const [isActive, setActive]  = useState(false);
    const handleClick = (event) => {
        event.preventDefault();
        setActive(!isActive);
        history.push(link);
    }
    console.log(rest);
    return (
        <li className="nav-item">
            <a href={`${link ? link : '#'}`} className={`nav-link ${match.path == link ? 'active' : ''}`} onClick={handleClick}>
                <i className={`nav-icon ${icon ? icon : 'far fa-circle'}`}></i>
                <p>
                    {LinkName}
                    {children}
                </p>
            </a>
        </li>
    );
}

export default withRouter(SidebarLink);
