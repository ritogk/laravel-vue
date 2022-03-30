<?php

namespace Tests\Feature\Api\V1\JobCategoryController;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;
// db
use App\Models\JobCategory;
// openapi
use App\OpenAPI;
use App\Libs\OpenAPIUtility;
// facker
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;

/**
 * get「/api/v1/job_categories/:id」のテスト
 */
class FindTest extends TestCase
{
    use DatabaseTransactions;

    private FakerGenerator $facker_generator;

    public function setUp(): void
    {
        parent::setUp();
        $this->facker_generator = FakerFactory::create('ja_JP');
    }

    /**
     * 正しいレスポンスが返ってくる事
     *
     * @return void
     */
    public function test_正しいレスポンスが返ってくる事()
    {
        // ダミデータを生成
        $job_category = JobCategory::factory()->create();

        // 返却されるはずのレスポンスディを生成
        $response_model = new OpenAPI\Model\JobCategory();
        $response_model->setName($job_category->name);
        $response_model->setContent($job_category->content);
        $response_model->setImage($job_category->image);
        $response_model->setImageUrl(config('filesystems.base_url') . Storage::url($job_category->image));
        $response_model->setSortNo($job_category->sort_no);
        $response_body = OpenAPIUtility::convertDict($response_model);

        /**
         * 確認項目
         */
        $response = $this->get(sprintf('/api/v1/job_categories/%s', $job_category->id));
        // レスポンスに想定する内容が含まれている事。
        $response->assertJson($response_body);
        // 正しいステータスコードが返ってくる事
        $response->assertStatus(200);
    }
}
