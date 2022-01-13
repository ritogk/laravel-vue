<?php

namespace Tests\Feature\Api\Master\JobCategory;

use Tests\TestCase;
use App\Models\JobCategory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;

class CreateTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * 200 test
     *
     * @return void
     */
    public function test_200()
    {
        // ログイン
        $this->post('/api/auth/admin/login', ['email'=>'test@test.co.jp', 'password'=>'test', 'remember'=>true]);

        $job_category = JobCategory::factory()->make();

        $this->post('/api/job_categories', $job_category->toArray())
            ->assertJson($job_category->toArray());
    }
}
