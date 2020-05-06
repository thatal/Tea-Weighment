import { UserTypes } from "./user.types";

const INITIAL_STATE = {
    user: null
}
export const userReducer = (state = INITIAL_STATE, action) => {
    switch (action.type) {
        case UserTypes.SET_AUTH_USER:
            return {
                ...state,
                user: action.payload
            }
        case userTypes.LOGGED_OUT:
            return {
                ...state,
                user: null
            }
        default:
            return state;
    }
}
