<?php

namespace Tests\Feature\Api\V1\JobCategoryController;

use Tests\TestCase;
use App\Models\JobCategory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;
// openapi
use App\OpenAPI;
use App\Libs\OpenAPIUtility;
// facker
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;

/**
 * get「/api/v1/job_categories」のテスト
 */
class ListTest extends TestCase
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
        // ダミデータを3件生成
        $job_category1 = JobCategory::factory()->create();
        $job_category2 = JobCategory::factory()->create();
        $job_category3 = JobCategory::factory()->create();

        // 返却されるはずのレスポンスディを三生成
        $response1_model = new OpenAPI\Model\JobCategory();
        $response1_model->setName($job_category1->name);
        $response1_model->setContent($job_category1->content);
        $response1_model->setImage($job_category1->image);
        $response1_model->setImageUrl(config('filesystems.base_url') . Storage::url($job_category1->image));
        $response1_model->setSortNo($job_category1->sort_no);
        $response1_body = OpenAPIUtility::convertDict($response1_model);

        $response2_model = new OpenAPI\Model\JobCategory();
        $response2_model->setName($job_category2->name);
        $response2_model->setContent($job_category2->content);
        $response2_model->setImage($job_category2->image);
        $response2_model->setImageUrl(config('filesystems.base_url') . Storage::url($job_category2->image));
        $response2_model->setSortNo($job_category2->sort_no);
        $response2_body = OpenAPIUtility::convertDict($response2_model);

        $response3_model = new OpenAPI\Model\JobCategory();
        $response3_model->setName($job_category3->name);
        $response3_model->setContent($job_category3->content);
        $response3_model->setImage($job_category3->image);
        $response3_model->setImageUrl(config('filesystems.base_url') . Storage::url($job_category3->image));
        $response3_model->setSortNo($job_category3->sort_no);
        $response3_body = OpenAPIUtility::convertDict($response3_model);

        /**
         * 確認項目
         */
        $response = $this->get('/api/v1/job_categories');
        // レスポンスにボディに想定する内容が含まれている事。
        $response->assertJsonCount(3);
        $response->assertJsonFragment($response1_body);
        $response->assertJsonFragment($response2_body);
        $response->assertJsonFragment($response3_body);
        // 正しいステータスコードが返ってくる事
        $response->assertStatus(200);
    }
}
