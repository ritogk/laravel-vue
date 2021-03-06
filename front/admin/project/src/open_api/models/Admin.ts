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
 * 管理者
 * @export
 * @interface Admin
 */
export interface Admin {
    /**
     * id
     * @type {number}
     * @memberof Admin
     */
    id?: number;
    /**
     * 名前
     * @type {string}
     * @memberof Admin
     */
    name?: string;
    /**
     * メールアドレス
     * @type {string}
     * @memberof Admin
     */
    email?: string;
    /**
     * 更新日時
     * @type {Date}
     * @memberof Admin
     */
    updatedAt?: Date;
    /**
     * 作成日時
     * @type {Date}
     * @memberof Admin
     */
    createdAt?: Date;
}

export function AdminFromJSON(json: any): Admin {
    return AdminFromJSONTyped(json, false);
}

export function AdminFromJSONTyped(json: any, ignoreDiscriminator: boolean): Admin {
    if ((json === undefined) || (json === null)) {
        return json;
    }
    return {
        
        'id': !exists(json, 'id') ? undefined : json['id'],
        'name': !exists(json, 'name') ? undefined : json['name'],
        'email': !exists(json, 'email') ? undefined : json['email'],
        'updatedAt': !exists(json, 'updatedAt') ? undefined : (new Date(json['updatedAt'])),
        'createdAt': !exists(json, 'createdAt') ? undefined : (new Date(json['createdAt'])),
    };
}

export function AdminToJSON(value?: Admin | null): any {
    if (value === undefined) {
        return undefined;
    }
    if (value === null) {
        return null;
    }
    return {
        
        'id': value.id,
        'name': value.name,
        'email': value.email,
        'updatedAt': value.updatedAt === undefined ? undefined : (value.updatedAt.toISOString().substr(0,10)),
        'createdAt': value.createdAt === undefined ? undefined : (value.createdAt.toISOString().substr(0,10)),
    };
}

