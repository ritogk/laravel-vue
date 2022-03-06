WORK_PATH='/out/ts'
# コード生成
docker run --rm -v ${PWD}:/local openapitools/openapi-generator-cli:v5.3.0 generate -i /local/api.yaml -g typescript-fetch -o /local${WORK_PATH} -c /local/config_ts.json

OUTPUT_PATH='../front/project/src/open_api'
# vue側にコピー
mkdir -p ${OUTPUT_PATH}
cp -r .${WORK_PATH}/* ${OUTPUT_PATH}
 
# 作業ディレクトリ削除
rm -rf ./out