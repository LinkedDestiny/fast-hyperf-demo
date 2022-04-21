<?php
declare(strict_types=1);

namespace LinkCloud\Fast\Hyperf\Demo\Repository\Dao\MySQL;

use LinkCloud\Fast\Hyperf\Demo\Model\User;
use LinkCloud\Fast\Hyperf\Demo\Repository\Dao\Contracts\UserDaoInterface;
use Hyperf\DbConnection\Db;
use LinkCloud\Fast\Hyperf\Constants\SoftDeleted;
use LinkCloud\Fast\Hyperf\Framework\BaseDao;
use LinkCloud\Fast\Hyperf\Framework\Entity\Page;
use LinkCloud\Fast\Hyperf\Helpers\ArrayHelper;

class UserDao extends BaseDao implements UserDaoInterface
{
    /**
     * @param array $condition
     * @param array $search
     * @param array $sort
     * @param Page $page
     * @param string[] $field
     * @return array
     */
    public function getList(array $condition, array $search, array $sort, Page $page, array $field = ['*']): array
    {
        $model = new User();
        $query = $model->newQuery()->where([
            'enable' => SoftDeleted::ENABLE,
        ])->select($field);

        $primaryKey = $model->getKeyName();

        foreach ($condition as $key => $value) {
            if (str_starts_with($key, 'with_')) {
                $query->with(substr($key, 5));
            }
        }

        foreach ($search as $key => $value) {
            if (is_int($key)) {
                $query->where($search);
                break;
            }
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        foreach ($sort as $key => $value) {
            $query->orderBy($key, $value);
        }

        $query->orderBy($primaryKey);
        return $this->output($query, $page);
    }

    /**
     * @param array $condition 控制参数
     * @param array $data 新增数据
     * @return array
     */
    public function create(array $condition, array $data): array
    {
        if (ArrayHelper::isValidValue($condition, 'multi_insert')) {
            $insert = [];
            $now = time();
            foreach ($data as $item) {
                $item['create_at'] = $item['update_at'] = $now;
                $insert[] = $item;
            }
            $ret = User::insertOrUpdate($insert, [
                'update_at' => DB::raw('values(`update_at`)'),
            ]);
            if (!$ret) {
                return [];
            }
            return $insert;
        }
        $model = (new User())->fill($data);
        $ret = $model->save();
        return $ret ? $model->toArray() : [];
    }

    /**
     * @param array $condition 控制参数
     * @param array $search 搜索参数
     * @param array $data 更新数据
     * @return int
     */
    public function modify(array $condition, array $search, array $data): int
    {
        return User::updateCondition($search, $data);
    }

    /**
     * @param array $condition 控制参数
     * @param array $search
     * @return int
     */
    public function remove(array $condition, array $search): int
    {
        $forceDelete = boolval($condition['force_delete'] ?? false);
        return User::removeCondition($search, $forceDelete);
    }

    /**
     * @param array $condition 控制参数
     * @param array $search 搜索参数
     * @param string[] $field 字段
     * @return array
     */
    public function detail(array $condition, array $search, array $field = ['*']): array
    {
        $forUpdate = boolval($condition['for_update'] ?? false);
        $model = User::findOne($search, $field, $forUpdate);
        if (!$model) {
            return [];
        }
        return $model->toArray();
    }
}