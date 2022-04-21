<?php

declare (strict_types=1);
namespace LinkCloud\Fast\Hyperf\Demo\Model;

use LinkCloud\Fast\Hyperf\Framework\BaseModel;
/**
 * @property int $user_id 用户ID
 * @property string $user_name 用户名称
 * @property int $status 状态
 * @property int $create_at 创建时间
 * @property int $update_at 更新时间
 * @property int $enable 软删除标记
 */
class User extends BaseModel
{
    /**
     * primaryKey
     */
    protected string $primaryKey = 'user_id';
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'user';
    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['user_id', 'user_name', 'status'];
    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['user_id' => 'integer', 'status' => 'integer', 'create_at' => 'datetime', 'update_at' => 'datetime', 'enable' => 'integer'];
}