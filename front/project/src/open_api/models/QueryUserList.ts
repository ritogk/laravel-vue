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
 * クエリパラメータ 会員一覧
 * @export
 * @interface QueryUserList
 */
export interface QueryUserList {
    /**
     * 氏名
     * @type {string}
     * @memberof QueryUserList
     */
    name?: string;
    /**
     * メールアドレス
     * @type {string}
     * @memberof QueryUserList
     */
    email?: string;
    /**
     * 自己PR
     * @type {string}
     * @memberof QueryUserList
     */
    selfPr?: string;
    /**
     * 電話番号
     * @type {string}
     * @memberof QueryUserList
     */
    tel?: string;
}

export function QueryUserListFromJSON(json: any): QueryUserList {
    return QueryUserListFromJSONTyped(json, false);
}

export function QueryUserListFromJSONTyped(json: any, ignoreDiscriminator: boolean): QueryUserList {
    if ((json === undefined) || (json === null)) {
        return json;
    }
    return {
        
        'name': !exists(json, 'name') ? undefined : json['name'],
        'email': !exists(json, 'email') ? undefined : json['email'],
        'selfPr': !exists(json, 'selfPr') ? undefined : json['selfPr'],
        'tel': !exists(json, 'tel') ? undefined : json['tel'],
    };
}

export function QueryUserListToJSON(value?: QueryUserList | null): any {
    if (value === undefined) {
        return undefined;
    }
    if (value === null) {
        return null;
    }
    return {
        
        'name': value.name,
        'email': value.email,
        'selfPr': value.selfPr,
        'tel': value.tel,
    };
}

