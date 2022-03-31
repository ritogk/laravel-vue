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
    FilePath,
    FilePathFromJSON,
    FilePathToJSON,
    RequestFile,
    RequestFileFromJSON,
    RequestFileToJSON,
} from '../models';

export interface OpenapiGeneratorPostRequest {
    requestFile?: RequestFile;
}

/**
 * OpenapiGeneratorApi - interface
 * 
 * @export
 * @interface OpenapiGeneratorApiInterface
 */
export interface OpenapiGeneratorApiInterface {
    /**
     * 未使用
     * @summary multipart/form-dataだとリクエストボディの型が生成されないので型を生成するためだけのAPI
     * @param {RequestFile} [requestFile] 
     * @param {*} [options] Override http request option.
     * @throws {RequiredError}
     * @memberof OpenapiGeneratorApiInterface
     */
    openapiGeneratorPostRaw(requestParameters: OpenapiGeneratorPostRequest, initOverrides?: RequestInit): Promise<runtime.ApiResponse<FilePath>>;

    /**
     * 未使用
     * multipart/form-dataだとリクエストボディの型が生成されないので型を生成するためだけのAPI
     */
    openapiGeneratorPost(requestParameters: OpenapiGeneratorPostRequest, initOverrides?: RequestInit): Promise<FilePath>;

}

/**
 * 
 */
export class OpenapiGeneratorApi extends runtime.BaseAPI implements OpenapiGeneratorApiInterface {

    /**
     * 未使用
     * multipart/form-dataだとリクエストボディの型が生成されないので型を生成するためだけのAPI
     */
    async openapiGeneratorPostRaw(requestParameters: OpenapiGeneratorPostRequest, initOverrides?: RequestInit): Promise<runtime.ApiResponse<FilePath>> {
        const queryParameters: any = {};

        const headerParameters: runtime.HTTPHeaders = {};

        headerParameters['Content-Type'] = 'application/json';

        if (this.configuration && this.configuration.accessToken) {
            const token = this.configuration.accessToken;
            const tokenString = await token("bearerAdmin", []);

            if (tokenString) {
                headerParameters["Authorization"] = `Bearer ${tokenString}`;
            }
        }
        const response = await this.request({
            path: `/openapi-generator`,
            method: 'POST',
            headers: headerParameters,
            query: queryParameters,
            body: RequestFileToJSON(requestParameters.requestFile),
        }, initOverrides);

        return new runtime.JSONApiResponse(response, (jsonValue) => FilePathFromJSON(jsonValue));
    }

    /**
     * 未使用
     * multipart/form-dataだとリクエストボディの型が生成されないので型を生成するためだけのAPI
     */
    async openapiGeneratorPost(requestParameters: OpenapiGeneratorPostRequest, initOverrides?: RequestInit): Promise<FilePath> {
        const response = await this.openapiGeneratorPostRaw(requestParameters, initOverrides);
        return await response.value();
    }

}
