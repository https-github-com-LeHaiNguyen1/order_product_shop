import { functions } from 'lodash';
import {http, httpFile} from '../http_service';

/**
 * The function creates a new product by sending a POST request to the '/products' endpoint using the
 * provided data.
 * @param data - The data parameter is an object that contains the information needed to create a new
 * product. This could include properties such as the product name, description, price, and any other
 * relevant details. The data object will be sent as the request body when the createProduct function
 * is called.
 * @returns The `createProduct` function is returning a Promise that will resolve with the result of a
 * POST request to the `/products` endpoint with the provided `data` as the request body.
 */
export function createProduct(data){
    return httpFile().post('/products', data);
}

export function loadProducts() {
    return http().get('/products');
}

export function deleteProducts(id) {
    return http().delete(`/products/${id}`);
}

export function updateProduct(id, data) {
    return httpFile().post(`/products/${id}`, data);
}