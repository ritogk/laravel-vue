<?php

namespace App\Libs;

class OpenAPIUtility
{

    /**
     * 「連想配列の一覧」を「OpenApiModel形式のcontainer一覧」に変換
     *
     * @param string $model_path モデルクラスのパス
     * @param array $items 変換元の一覧
     * @return array
     */
    static function dicstonariesToModelContainers(string $model_path, array $dicstonaries): array
    {
        $converted = [];
        foreach ($dicstonaries as $key => $dicstonary) {
            $model_container = [];
            $model = new $model_path(
                $dicstonary
            );
            $converted[] = json_decode(json_encode($model));
        }
        return $converted;
    }
}
