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
 * リクエスト 応募登録
 * @export
 * @interface RequestEntry
 */
export interface RequestEntry {
    /**
     * 仕事id
     * @type {number}
     * @memberof RequestEntry
     */
    jobId: number;
    /**
     * ユーザーid
     * @type {number}
     * @memberof RequestEntry
     */
    userId?: number;
}

export function RequestEntryFromJSON(json: any): RequestEntry {
    return RequestEntryFromJSONTyped(json, false);
}

export function RequestEntryFromJSONTyped(json: any, ignoreDiscriminator: boolean): RequestEntry {
    if ((json === undefined) || (json === null)) {
        return json;
    }
    return {
        
        'jobId': json['jobId'],
        'userId': !exists(json, 'userId') ? undefined : json['userId'],
    };
}

export function RequestEntryToJSON(value?: RequestEntry | null): any {
    if (value === undefined) {
        return undefined;
    }
    if (value === null) {
        return null;
    }
    return {
        
        'jobId': value.jobId,
        'userId': value.userId,
    };
}

