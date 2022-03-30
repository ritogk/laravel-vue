WORK_PATH='/out/ts'
# コード生成
docker run --rm -v ${PWD}:/local openapitools/openapi-generator-cli:v5.3.0 generate -i /local/api.yaml -g typescript-fetch -o /local${WORK_PATH} -c /local/config_ts.json

OUTPUT_USER_PATH='../front/user/project/src/open_api'
OUTPUT_ADMIN_PATH='../front/admin/project/src/open_api'
# vue側にコピー
rm -rf ${OUTPUT_USER_PATH}
mkdir -p ${OUTPUT_USER_PATH}
cp -r .${WORK_PATH}/* ${OUTPUT_USER_PATH}
cp ./api.yaml ${OUTPUT_USER_PATH}
rm -rf ${OUTPUT_ADMIN_PATH}
mkdir -p ${OUTPUT_ADMIN_PATH}
cp -r .${WORK_PATH}/* ${OUTPUT_ADMIN_PATH}
cp ./api.yaml ${OUTPUT_ADMIN_PATH}

# 作業ディレクトリ削除
rm -rf ./out