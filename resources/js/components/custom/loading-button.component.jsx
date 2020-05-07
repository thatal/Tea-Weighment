import React from 'react';
import CustomButton from './custom.button';
import CustomIcon from './spinner-icon.component';

const LoadingButton = ({loading, ...rest}) => {
    return (
        <CustomButton disabled={loading} {...rest}>
            {
                loading ? <CustomIcon style={{marginRight: '3px'}}/> : ''
            }
        </CustomButton>
    );
}
export default LoadingButton;
