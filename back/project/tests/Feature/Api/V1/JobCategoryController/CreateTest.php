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
 * POST「/api/v1/job_categories」のテスト
 */
class CreateTest extends TestCase
{
    use DatabaseTransactions;

    private FakerGenerator $facker_generator;

    public function setUp(): void
    {
        parent::setUp();
        $this->facker_generator = FakerFactory::create('ja_JP');
    }

    /**
     * 管理者がログイン済の状態で、正しい処理が行われる事
     *
     * @return void
     */
    public function test_管理者がログイン済の状態で正しい処理が行われる事()
    {
        // 管理者を作成
        $admin_user = AdminUser::factory()->create();
        // ログイン
        $this->post('/api/v1/auth/admin/login', ['email' => $admin_user->email, 'password' => 'test']);

        // リクエストのボディを生成
        $request_model = new OpenAPI\Model\RequestJobCategory();
        $request_model->setName($this->facker_generator->name());
        $request_model->setContent($this->facker_generator->realText(1000));
        $request_model->setImage($this->facker_generator->filePath());
        $request_model->setSortNo($this->facker_generator->numberBetween(1, 10));
        $request_body = OpenAPIUtility::convertDict($request_model);

        // 返却されるはずのレスポンスボディを生成
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
        $response = $this->post('/api/v1/job_categories', $request_body);
        // 想定するレスポンスボディが含まれている事。
        $response->assertJson($response_body);
        // 正しいステータスコードが返ってくる事
        $response->assertStatus(201);
        // リクエストボディで指定した内容がテーブルに登録されている事
        $this->assertTrue(JobCategory::where('name', $request_model->getName())
            ->where('content', $request_model->getContent())
            ->where('image', $request_model->getImage())
            ->where('sort_no', $request_model->getSortNo())
            ->exists());
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
