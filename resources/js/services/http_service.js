import store from "../store";
import axios from "axios";

/**
 * This function returns an instance of Axios with a base URL set to the value of a state variable.
 * @returns A function that creates an instance of Axios with a base URL set to the value of
 * `store.state.apiURL`.
 */
export function http(){
    return axios.create({
        baseURL: store.state.apiURL
    });
}

/**
 * This function creates an instance of axios with a base URL and headers for sending
 * multipart/form-data requests.
 * @returns A function that creates an instance of Axios with a base URL and headers for sending
 * multipart/form-data requests.
 */
export function httpFile(){
    return axios.create({
        baseURL: store.state.apiURL,
        headers: {
            'Content-Type': 'multipart/from-data'
        }
    });
}
