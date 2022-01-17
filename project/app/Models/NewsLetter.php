<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DateTimeInterface;

/**
 * App\Models\NewsLetter
 *
 * @property int $id
 * @property string $subject 件名
 * @property string $message メッセージ
 * @property int $send 送信済
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter newQuery()
 * @method static \Illuminate\Database\Query\Builder|NewsLetter onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter query()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter whereSend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsLetter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|NewsLetter withTrashed()
 * @method static \Illuminate\Database\Query\Builder|NewsLetter withoutTrashed()
 * @mixin \Eloquent
 */
class NewsLetter extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = ['id', 'updated_at', 'created_at', 'deleted_at']; // ブラックリスト

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
