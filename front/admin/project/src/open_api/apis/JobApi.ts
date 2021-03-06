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
    Job,
    JobFromJSON,
    JobToJSON,
    RequestJob,
    RequestJobFromJSON,
    RequestJobToJSON,
} from '../models';

export interface JobsGetRequest {
    title?: string;
    content?: string;
    attention?: boolean;
    jobCategoryId?: number;
    price?: number;
    welfare?: string;
    holiday?: string;
}

export interface JobsIdDeleteRequest {
    id: number;
}

export interface JobsIdGetRequest {
    id: number;
}

export interface JobsIdPutRequest {
    id: number;
    requestJob?: RequestJob;
}

export interface JobsPostRequest {
    requestJob?: RequestJob;
}

/**
 * JobApi - interface
 * 
 * @export
 * @interface JobApiInterface
 */
export interface JobApiInterface {
    /**
     * 詳細内容
     * @summary 一覧取得
     * @param {string} [title] タイトル
     * @param {string} [content] 内容
     * @param {boolean} [attention] 注目の求人
     * @param {number} [jobCategoryId] 職種id
     * @param {number} [price] 金額
     * @param {string} [welfare] 福利厚生
     * @param {string} [holiday] 休日
     * @param {*} [options] Override http request option.
     * @throws {RequiredError}
     * @memberof JobApiInterface
     */
    jobsGetRaw(requestParameters: JobsGetRequest, initOverrides?: RequestInit): Promise<runtime.ApiResponse<Array<Job>>>;

    /**
     * 詳細内容
     * 一覧取得
     */
    jobsGet(requestParameters: JobsGetRequest, initOverrides?: RequestInit): Promise<Array<Job>>;

    /**
     * 詳細内容
     * @summary 削除
     * @param {number} id 
     * @param {*} [options] Override http request option.
     * @throws {RequiredError}
     * @memberof JobApiInterface
     */
    jobsIdDeleteRaw(requestParameters: JobsIdDeleteRequest, initOverrides?: RequestInit): Promise<runtime.ApiResponse<Job>>;

    /**
     * 詳細内容
     * 削除
     */
    jobsIdDelete(requestParameters: JobsIdDeleteRequest, initOverrides?: RequestInit): Promise<Job>;

    /**
     * 詳細内容
     * @summary 1件取得
     * @param {number} id 
     * @param {*} [options] Override http request option.
     * @throws {RequiredError}
     * @memberof JobApiInterface
     */
    jobsIdGetRaw(requestParameters: JobsIdGetRequest, initOverrides?: RequestInit): Promise<runtime.ApiResponse<Job>>;

    /**
     * 詳細内容
     * 1件取得
     */
    jobsIdGet(requestParameters: JobsIdGetRequest, initOverrides?: RequestInit): Promise<Job>;

    /**
     * 詳細内容
     * @summary 更新
     * @param {number} id 
     * @param {RequestJob} [requestJob] 
     * @param {*} [options] Override http request option.
     * @throws {RequiredError}
     * @memberof JobApiInterface
     */
    jobsIdPutRaw(requestParameters: JobsIdPutRequest, initOverrides?: RequestInit): Promise<runtime.ApiResponse<Job>>;

    /**
     * 詳細内容
     * 更新
     */
    jobsIdPut(requestParameters: JobsIdPutRequest, initOverrides?: RequestInit): Promise<Job>;

    /**
     * 詳細内容
     * @summary 仕事 追加
     * @param {RequestJob} [requestJob] 
     * @param {*} [options] Override http request option.
     * @throws {RequiredError}
     * @memberof JobApiInterface
     */
    jobsPostRaw(requestParameters: JobsPostRequest, initOverrides?: RequestInit): Promise<runtime.ApiResponse<Job>>;

    /**
     * 詳細内容
     * 仕事 追加
     */
    jobsPost(requestParameters: JobsPostRequest, initOverrides?: RequestInit): Promise<Job>;

}

/**
 * 
 */
export class JobApi extends runtime.BaseAPI implements JobApiInterface {

    /**
     * 詳細内容
     * 一覧取得
     */
    async jobsGetRaw(requestParameters: JobsGetRequest, initOverrides?: RequestInit): Promise<runtime.ApiResponse<Array<Job>>> {
        const queryParameters: any = {};

        if (requestParameters.title !== undefined) {
            queryParameters['title'] = requestParameters.title;
        }

        if (requestParameters.content !== undefined) {
            queryParameters['content'] = requestParameters.content;
        }

        if (requestParameters.attention !== undefined) {
            queryParameters['attention'] = requestParameters.attention;
        }

        if (requestParameters.jobCategoryId !== undefined) {
            queryParameters['jobCategoryId'] = requestParameters.jobCategoryId;
        }

        if (requestParameters.price !== undefined) {
            queryParameters['price'] = requestParameters.price;
        }

        if (requestParameters.welfare !== undefined) {
            queryParameters['welfare'] = requestParameters.welfare;
        }

        if (requestParameters.holiday !== undefined) {
            queryParameters['holiday'] = requestParameters.holiday;
        }

        const headerParameters: runtime.HTTPHeaders = {};

        const response = await this.request({
            path: `/jobs`,
            method: 'GET',
            headers: headerParameters,
            query: queryParameters,
        }, initOverrides);

        return new runtime.JSONApiResponse(response, (jsonValue) => jsonValue.map(JobFromJSON));
    }

    /**
     * 詳細内容
     * 一覧取得
     */
    async jobsGet(requestParameters: JobsGetRequest, initOverrides?: RequestInit): Promise<Array<Job>> {
        const response = await this.jobsGetRaw(requestParameters, initOverrides);
        return await response.value();
    }

    /**
     * 詳細内容
     * 削除
     */
    async jobsIdDeleteRaw(requestParameters: JobsIdDeleteRequest, initOverrides?: RequestInit): Promise<runtime.ApiResponse<Job>> {
        if (requestParameters.id === null || requestParameters.id === undefined) {
            throw new runtime.RequiredError('id','Required parameter requestParameters.id was null or undefined when calling jobsIdDelete.');
        }

        const queryParameters: any = {};

        const headerParameters: runtime.HTTPHeaders = {};

        if (this.configuration && this.configuration.accessToken) {
            const token = this.configuration.accessToken;
            const tokenString = await token("bearerAdmin", []);

            if (tokenString) {
                headerParameters["Authorization"] = `Bearer ${tokenString}`;
            }
        }
        const response = await this.request({
            path: `/jobs/{id}`.replace(`{${"id"}}`, encodeURIComponent(String(requestParameters.id))),
            method: 'DELETE',
            headers: headerParameters,
            query: queryParameters,
        }, initOverrides);

        return new runtime.JSONApiResponse(response, (jsonValue) => JobFromJSON(jsonValue));
    }

    /**
     * 詳細内容
     * 削除
     */
    async jobsIdDelete(requestParameters: JobsIdDeleteRequest, initOverrides?: RequestInit): Promise<Job> {
        const response = await this.jobsIdDeleteRaw(requestParameters, initOverrides);
        return await response.value();
    }

    /**
     * 詳細内容
     * 1件取得
     */
    async jobsIdGetRaw(requestParameters: JobsIdGetRequest, initOverrides?: RequestInit): Promise<runtime.ApiResponse<Job>> {
        if (requestParameters.id === null || requestParameters.id === undefined) {
            throw new runtime.RequiredError('id','Required parameter requestParameters.id was null or undefined when calling jobsIdGet.');
        }

        const queryParameters: any = {};

        const headerParameters: runtime.HTTPHeaders = {};

        const response = await this.request({
            path: `/jobs/{id}`.replace(`{${"id"}}`, encodeURIComponent(String(requestParameters.id))),
            method: 'GET',
            headers: headerParameters,
            query: queryParameters,
        }, initOverrides);

        return new runtime.JSONApiResponse(response, (jsonValue) => JobFromJSON(jsonValue));
    }

    /**
     * 詳細内容
     * 1件取得
     */
    async jobsIdGet(requestParameters: JobsIdGetRequest, initOverrides?: RequestInit): Promise<Job> {
        const response = await this.jobsIdGetRaw(requestParameters, initOverrides);
        return await response.value();
    }

    /**
     * 詳細内容
     * 更新
     */
    async jobsIdPutRaw(requestParameters: JobsIdPutRequest, initOverrides?: RequestInit): Promise<runtime.ApiResponse<Job>> {
        if (requestParameters.id === null || requestParameters.id === undefined) {
            throw new runtime.RequiredError('id','Required parameter requestParameters.id was null or undefined when calling jobsIdPut.');
        }

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
            path: `/jobs/{id}`.replace(`{${"id"}}`, encodeURIComponent(String(requestParameters.id))),
            method: 'PUT',
            headers: headerParameters,
            query: queryParameters,
            body: RequestJobToJSON(requestParameters.requestJob),
        }, initOverrides);

        return new runtime.JSONApiResponse(response, (jsonValue) => JobFromJSON(jsonValue));
    }

    /**
     * 詳細内容
     * 更新
     */
    async jobsIdPut(requestParameters: JobsIdPutRequest, initOverrides?: RequestInit): Promise<Job> {
        const response = await this.jobsIdPutRaw(requestParameters, initOverrides);
        return await response.value();
    }

    /**
     * 詳細内容
     * 仕事 追加
     */
    async jobsPostRaw(requestParameters: JobsPostRequest, initOverrides?: RequestInit): Promise<runtime.ApiResponse<Job>> {
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
            path: `/jobs`,
            method: 'POST',
            headers: headerParameters,
            query: queryParameters,
            body: RequestJobToJSON(requestParameters.requestJob),
        }, initOverrides);

        return new runtime.JSONApiResponse(response, (jsonValue) => JobFromJSON(jsonValue));
    }

    /**
     * 詳細内容
     * 仕事 追加
     */
    async jobsPost(requestParameters: JobsPostRequest, initOverrides?: RequestInit): Promise<Job> {
        const response = await this.jobsPostRaw(requestParameters, initOverrides);
        return await response.value();
    }

}
