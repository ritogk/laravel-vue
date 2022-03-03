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

import { exists, mapValues } from '../runtime';
/**
 * リクエスト 仕事登録
 * @export
 * @interface RequestJob
 */
export interface RequestJob {
    /**
     * タイトル
     * @type {string}
     * @memberof RequestJob
     */
    title: string;
    /**
     * 内容
     * @type {string}
     * @memberof RequestJob
     */
    content: string;
    /**
     * 注目の求人
     * @type {boolean}
     * @memberof RequestJob
     */
    attention: boolean;
    /**
     * 職種id
     * @type {number}
     * @memberof RequestJob
     */
    jobCategoryId: number;
    /**
     * 金額
     * @type {number}
     * @memberof RequestJob
     */
    price: number;
    /**
     * 福利厚生
     * @type {string}
     * @memberof RequestJob
     */
    welfare?: string;
    /**
     * 休日
     * @type {string}
     * @memberof RequestJob
     */
    holiday?: string;
    /**
     * 画像URL
     * @type {string}
     * @memberof RequestJob
     */
    image: string;
    /**
     * 並び順
     * @type {number}
     * @memberof RequestJob
     */
    sortNo: number;
    /**
     * 更新日時
     * @type {Date}
     * @memberof RequestJob
     */
    updatedAt?: Date;
}

export function RequestJobFromJSON(json: any): RequestJob {
    return RequestJobFromJSONTyped(json, false);
}

export function RequestJobFromJSONTyped(json: any, ignoreDiscriminator: boolean): RequestJob {
    if ((json === undefined) || (json === null)) {
        return json;
    }
    return {
        
        'title': json['title'],
        'content': json['content'],
        'attention': json['attention'],
        'jobCategoryId': json['jobCategoryId'],
        'price': json['price'],
        'welfare': !exists(json, 'welfare') ? undefined : json['welfare'],
        'holiday': !exists(json, 'holiday') ? undefined : json['holiday'],
        'image': json['image'],
        'sortNo': json['sortNo'],
        'updatedAt': !exists(json, 'updatedAt') ? undefined : (new Date(json['updatedAt'])),
    };
}

export function RequestJobToJSON(value?: RequestJob | null): any {
    if (value === undefined) {
        return undefined;
    }
    if (value === null) {
        return null;
    }
    return {
        
        'title': value.title,
        'content': value.content,
        'attention': value.attention,
        'jobCategoryId': value.jobCategoryId,
        'price': value.price,
        'welfare': value.welfare,
        'holiday': value.holiday,
        'image': value.image,
        'sortNo': value.sortNo,
        'updatedAt': value.updatedAt === undefined ? undefined : (value.updatedAt.toISOString().substr(0,10)),
    };
}
