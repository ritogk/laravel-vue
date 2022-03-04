/* tslint:disable */
/* eslint-disable */
/**
 * OpenAPI Tutorial
 * OpenAPI Tutorial by halhorn
 *
 * The version of the OpenAPI document: 0.0.0
 * 
 *
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


import * as runtime from '../runtime';
import {
    QueryUserList,
    QueryUserListFromJSON,
    QueryUserListToJSON,
    RequestUser,
    RequestUserFromJSON,
    RequestUserToJSON,
    User,
    UserFromJSON,
    UserToJSON,
} from '../models';

export interface UsersGetRequest {
    values?: QueryUserList;
}

export interface UsersPostRequest {
    requestUser?: RequestUser;
}

/**
 * UserApi - interface
 * 
 * @export
 * @interface UserApiInterface
 */
export interface UserApiInterface {
    /**
     * 詳細内容
     * @summary 一覧取得
     * @param {QueryUserList} [values] 
     * @param {*} [options] Override http request option.
     * @throws {RequiredError}
     * @memberof UserApiInterface
     */
    usersGetRaw(requestParameters: UsersGetRequest, initOverrides?: RequestInit): Promise<runtime.ApiResponse<Array<User>>>;

    /**
     * 詳細内容
     * 一覧取得
     */
    usersGet(requestParameters: UsersGetRequest, initOverrides?: RequestInit): Promise<Array<User>>;

    /**
     * 詳細内容
     * @summary 会員 追加
     * @param {RequestUser} [requestUser] 
     * @param {*} [options] Override http request option.
     * @throws {RequiredError}
     * @memberof UserApiInterface
     */
    usersPostRaw(requestParameters: UsersPostRequest, initOverrides?: RequestInit): Promise<runtime.ApiResponse<User>>;

    /**
     * 詳細内容
     * 会員 追加
     */
    usersPost(requestParameters: UsersPostRequest, initOverrides?: RequestInit): Promise<User>;

}

/**
 * 
 */
export class UserApi extends runtime.BaseAPI implements UserApiInterface {

    /**
     * 詳細内容
     * 一覧取得
     */
    async usersGetRaw(requestParameters: UsersGetRequest, initOverrides?: RequestInit): Promise<runtime.ApiResponse<Array<User>>> {
        const queryParameters: any = {};

        if (requestParameters.values !== undefined) {
            queryParameters['values'] = requestParameters.values;
        }

        const headerParameters: runtime.HTTPHeaders = {};

        if (this.configuration && this.configuration.accessToken) {
            const token = this.configuration.accessToken;
            const tokenString = await token("bearerAdmin", []);

            if (tokenString) {
                headerParameters["Authorization"] = `Bearer ${tokenString}`;
            }
        }
        const response = await this.request({
            path: `/users`,
            method: 'GET',
            headers: headerParameters,
            query: queryParameters,
        }, initOverrides);

        return new runtime.JSONApiResponse(response, (jsonValue) => jsonValue.map(UserFromJSON));
    }

    /**
     * 詳細内容
     * 一覧取得
     */
    async usersGet(requestParameters: UsersGetRequest, initOverrides?: RequestInit): Promise<Array<User>> {
        const response = await this.usersGetRaw(requestParameters, initOverrides);
        return await response.value();
    }

    /**
     * 詳細内容
     * 会員 追加
     */
    async usersPostRaw(requestParameters: UsersPostRequest, initOverrides?: RequestInit): Promise<runtime.ApiResponse<User>> {
        const queryParameters: any = {};

        const headerParameters: runtime.HTTPHeaders = {};

        headerParameters['Content-Type'] = 'application/json';

        const response = await this.request({
            path: `/users`,
            method: 'POST',
            headers: headerParameters,
            query: queryParameters,
            body: RequestUserToJSON(requestParameters.requestUser),
        }, initOverrides);

        return new runtime.JSONApiResponse(response, (jsonValue) => UserFromJSON(jsonValue));
    }

    /**
     * 詳細内容
     * 会員 追加
     */
    async usersPost(requestParameters: UsersPostRequest, initOverrides?: RequestInit): Promise<User> {
        const response = await this.usersPostRaw(requestParameters, initOverrides);
        return await response.value();
    }

}