OUTPUT_PATH='/out/php'
docker run --rm -v ${PWD}:/local openapitools/openapi-generator-cli generate -i /local/api.yaml -g php -o /local${OUTPUT_PATH} -c /local/config.json


# 定数名(enum)の前に自動的に付与される文字を削除
grep -l 'NUMBER_' .${OUTPUT_PATH}/lib/Model/* | xargs sed -i 's/NUMBER_//g'

# laravelに合わせて名前空間を変更
grep -lr '\\OpenAPI\\Client\\' .${OUTPUT_PATH}/lib/* | xargs sed -i 's/\\OpenAPI\\Client\\/App\\OpenAPI\\/g'
grep -lr 'OpenAPI\\Client' .${OUTPUT_PATH}/lib/* | xargs sed -i 's/OpenAPI\\Client/App\\OpenAPI/g'

# laravel側にmodelをコピー
mkdir -p ../project/app/OpenAPI 
cp -r ./out/php/lib/* ../project/app/OpenAPI
cp api.yaml ../project/app/OpenAPI

# 作業ディレクトリ削除
rm -rf ./out