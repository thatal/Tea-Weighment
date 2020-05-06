import { UserTypes } from "./user.types"

export const setAuthUser = (user) => ({
    type: UserTypes.SET_AUTH_USER,
    payload: user
})
export const loggedOutUser = () => ({
    type: UserTypes.LOGGED_OUT
})
