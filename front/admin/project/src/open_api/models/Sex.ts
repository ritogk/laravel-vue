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

/**
 * man: 男
 * woman: 女
 * @export
 * @enum {string}
 */
export enum Sex {
    MAN = 1,
    WOMAN = 2
}

export function SexFromJSON(json: any): Sex {
    return SexFromJSONTyped(json, false);
}

export function SexFromJSONTyped(json: any, ignoreDiscriminator: boolean): Sex {
    return json as Sex;
}

export function SexToJSON(value?: Sex | null): any {
    return value as any;
}

