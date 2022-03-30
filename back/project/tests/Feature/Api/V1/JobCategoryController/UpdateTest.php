<?php

namespace Tests\Feature\Api\V1\JobCategoryController;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;
// db
use App\Models\JobCategory;
use App\Models\AdminUser;
// openapi
use App\OpenAPI;
use App\Libs\OpenAPIUtility;
// facker
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;

/**
 * PUT 「/api/v1/job_categories/:id」のテスト
 */
class UpdateTest extends TestCase
{
    use DatabaseTransactions;

    private FakerGenerator $facker_generator;

    public function setUp(): void
    {
        parent::setUp();
        $this->facker_generator = FakerFactory::create('ja_JP');
    }

    /**
     * test_管理者がログイン済の状態で正しい処理が行われる事
     *
     * @return void
     */
    public function test_管理者がログイン済の状態で正しい処理が行われる事()
    {
        // 管理者を作成
        $admin_user = AdminUser::factory()->create();
        // ログイン
        $this->post('/api/v1/auth/admin/login', ['email' => $admin_user->email, 'password' => 'test']);

        // ダミデータを生成
        $job_category = JobCategory::factory()->create();

        // リクエストのボディを生成
        $request_model = new OpenAPI\Model\RequestJobCategory();
        $request_model->setName($this->facker_generator->name());
        $request_model->setContent($this->facker_generator->realText(1000));
        $request_model->setImage($this->facker_generator->filePath());
        $request_model->setSortNo($this->facker_generator->numberBetween(1, 10));
        $request_body = OpenAPIUtility::convertDict($request_model);

        // 返却されるはずのレスポンスディを生成
        $response_model = new OpenAPI\Model\JobCategory();
        $response_model->setName($request_model->getName());
        $response_model->setContent($request_model->getContent());
        $response_model->setImage($request_model->getImage());
        $response_model->setImageUrl(config('filesystems.base_url') . Storage::url($request_model->getImage()));
        $response_model->setSortNo($request_model->getSortNo());
        $response_body = OpenAPIUtility::convertDict($response_model);

        /**
         * 確認項目
         */
        $response = $this->put(sprintf('/api/v1/job_categories/%s', $job_category->id), $request_body);
        // レスポンスに想定する内容が含まれている事。
        $response->assertJson($response_body);
        // 正しいステータスコードが返ってくる事
        $response->assertStatus(200);
        // 職種テーブルが更新されている事
        $this->assertTrue(
            JobCategory::where('id', $job_category->id)
                ->where('name', $job_category->name)
                ->where('image', $job_category->image)
                ->where('sort_no', $job_category->sort_no)
                ->doesntExist()
        );
    }

    /**
     * 管理者が未ログインの場合は実行されない事
     *
     * @return void
     */
    public function test_管理者が未ログインの場合は実行されない事()
    {
        // リクエストのボディを生成
        $request_model = new OpenAPI\Model\RequestJobCategory();
        $request_model->setName($this->facker_generator->name());
        $request_model->setContent($this->facker_generator->realText(1000));
        $request_model->setImage($this->facker_generator->filePath());
        $request_model->setSortNo($this->facker_generator->numberBetween(1, 10));
        $request_body = OpenAPIUtility::convertDict($request_model);

        /**
         * 確認項目
         */
        $response = $this->post('/api/v1/job_categories', $request_body);
        // 正しいステータスコードが返ってくる事
        $response->assertStatus(401);
    }
}
