<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DateTimeInterface;

/**
 * App\Models\Entry
 *
 * @property int $id
 * @property int $job_id 仕事ID
 * @property int $user_id 会員ID
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Job $jobs
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\EntryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entry newQuery()
 * @method static \Illuminate\Database\Query\Builder|Entry onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Entry query()
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Entry withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Entry withoutTrashed()
 * @mixin \Eloquent
 */
class Entry extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = ['id', 'updated_at', 'created_at', 'deleted_at']; // ブラックリスト

    // リレーション
    public function jobs()
    {
        return $this->belongsTo('App\Models\Job');
    }

    // リレーション
    public function user()
    {
        return $this->belongsTo('App\Models\User');
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
