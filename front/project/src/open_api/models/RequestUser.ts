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
 * リクエスト 会員登録
 * @export
 * @interface RequestUser
 */
export interface RequestUser {
    /**
     * 氏名
     * @type {string}
     * @memberof RequestUser
     */
    name: string;
    /**
     * メールアドレス
     * @type {string}
     * @memberof RequestUser
     */
    email: string;
    /**
     * パスワード
     * @type {string}
     * @memberof RequestUser
     */
    password: string;
    /**
     * パスワード(確認)
     * @type {string}
     * @memberof RequestUser
     */
    passwordConfirmation: string;
    /**
     * 自己PR
     * @type {string}
     * @memberof RequestUser
     */
    selfPr: string;
    /**
     * 電話番号
     * @type {string}
     * @memberof RequestUser
     */
    tel: string;
}

export function RequestUserFromJSON(json: any): RequestUser {
    return RequestUserFromJSONTyped(json, false);
}

export function RequestUserFromJSONTyped(json: any, ignoreDiscriminator: boolean): RequestUser {
    if ((json === undefined) || (json === null)) {
        return json;
    }
    return {
        
        'name': json['name'],
        'email': json['email'],
        'password': json['password'],
        'passwordConfirmation': json['passwordConfirmation'],
        'selfPr': json['selfPr'],
        'tel': json['tel'],
    };
}

export function RequestUserToJSON(value?: RequestUser | null): any {
    if (value === undefined) {
        return undefined;
    }
    if (value === null) {
        return null;
    }
    return {
        
        'name': value.name,
        'email': value.email,
        'password': value.password,
        'passwordConfirmation': value.passwordConfirmation,
        'selfPr': value.selfPr,
        'tel': value.tel,
    };
}
