<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTimeInterface;

/**
 * App\Models\Job
 *
 * @property int $id
 * @property string $title タイトル
 * @property string $content 内容
 * @property int $attention 注目の求人
 * @property int $job_category_id 仕事カテゴリID
 * @property int $price 金額
 * @property string|null $welfare 福利厚生
 * @property string|null $holiday 休日
 * @property string $image 画像パス
 * @property int $sort_no 並び順
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Entry[] $entries
 * @property-read int|null $entries_count
 * @property-read \App\Models\JobCategory $jobCategory
 * @method static \Illuminate\Database\Eloquent\Builder|Job newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Job newQuery()
 * @method static \Illuminate\Database\Query\Builder|Job onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Job query()
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereAttention($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereHoliday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereJobCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereSortNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereWelfare($value)
 * @method static \Illuminate\Database\Query\Builder|Job withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Job withoutTrashed()
 * @mixin \Eloquent
 */
class Job extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'updated_at', 'created_at', 'deleted_at']; // ブラックリスト

    protected $casts = [
        'attention' => 'boolean'
    ];

    // リレーション
    public function jobCategory()
    {
        return $this->belongsTo('App\Models\JobCategory');
    }

    // リレーション
    public function entries()
    {
        return $this->hasMany('App\Models\Entry');
    }

    /**
     * 日時を日本時間に変換する
     * laravel7からtoArray, toJson内の日時がUTC固定になったので
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
