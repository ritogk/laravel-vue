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
 * 職種
 * @export
 * @interface JobCategory
 */
export interface JobCategory {
    /**
     * id
     * @type {number}
     * @memberof JobCategory
     */
    id?: number;
    /**
     * 名称
     * @type {string}
     * @memberof JobCategory
     */
    name?: string;
    /**
     * 内容
     * @type {string}
     * @memberof JobCategory
     */
    content?: string;
    /**
     * 画像URL
     * @type {string}
     * @memberof JobCategory
     */
    image?: string;
    /**
     * 並び順
     * @type {number}
     * @memberof JobCategory
     */
    sortNo?: number;
    /**
     * 作成日時
     * @type {Date}
     * @memberof JobCategory
     */
    createdAt?: Date;
    /**
     * 更新日時
     * @type {Date}
     * @memberof JobCategory
     */
    updatedAt?: Date;
}

export function JobCategoryFromJSON(json: any): JobCategory {
    return JobCategoryFromJSONTyped(json, false);
}

export function JobCategoryFromJSONTyped(json: any, ignoreDiscriminator: boolean): JobCategory {
    if ((json === undefined) || (json === null)) {
        return json;
    }
    return {
        
        'id': !exists(json, 'id') ? undefined : json['id'],
        'name': !exists(json, 'name') ? undefined : json['name'],
        'content': !exists(json, 'content') ? undefined : json['content'],
        'image': !exists(json, 'image') ? undefined : json['image'],
        'sortNo': !exists(json, 'sortNo') ? undefined : json['sortNo'],
        'createdAt': !exists(json, 'createdAt') ? undefined : (new Date(json['createdAt'])),
        'updatedAt': !exists(json, 'updatedAt') ? undefined : (new Date(json['updatedAt'])),
    };
}

export function JobCategoryToJSON(value?: JobCategory | null): any {
    if (value === undefined) {
        return undefined;
    }
    if (value === null) {
        return null;
    }
    return {
        
        'id': value.id,
        'name': value.name,
        'content': value.content,
        'image': value.image,
        'sortNo': value.sortNo,
        'createdAt': value.createdAt === undefined ? undefined : (value.createdAt.toISOString().substr(0,10)),
        'updatedAt': value.updatedAt === undefined ? undefined : (value.updatedAt.toISOString().substr(0,10)),
    };
}
