<?php
declare(strict_types=1);

namespace LinkCloud\Fast\Hyperf\Demo\Service;

use LinkCloud\Fast\Hyperf\Demo\Repository\Dao\Contracts\UserDaoInterface;
use LinkCloud\Fast\Hyperf\Demo\Constants\Errors\UserError;
use Hyperf\Di\Annotation\Inject;
use LinkCloud\Fast\Hyperf\Framework\BaseService;
use LinkCloud\Fast\Hyperf\Framework\Entity\Page;
use LinkCloud\Fast\Hyperf\Framework\Exception\BusinessException;
use LinkCloud\Fast\Hyperf\Helpers\ArrayHelper;
use Throwable;

class UserService extends BaseService
{

    #[Inject]
    protected UserDaoInterface $userDao;

    /**
     * @param array $condition
     * @param array $search
     * @param array $sort
     * @param Page $page
     * @param array $field
     * @return array
     */
    public function getList(array $condition, array $search, array $sort, Page $page, array $field = ['*']): array
    {
        $result = $this->userDao->getList($condition, $search, $sort, $page, $field);
        if (!ArrayHelper::isValidValue($condition, 'auto_format')) {
            return $result;
        }
        $result['list'] = $this->toArray($result['list'], function ($data) use ($condition) {
            return $this->format($data, $condition);
        });
        return $result;
    }

    /**
     * @param array $condition
     * @param array $data
     * @return array
     * @throws BusinessException
     */
    public function create(array $condition, array $data): array
    {
        $data = $this->validate($condition, $data);
        $result = $this->userDao->create($condition, $data);
        if (empty($result)) {
            throw new BusinessException(UserError::CREATE_ERROR());
        }
        if (ArrayHelper::isValidValue($condition, 'auto_format')) {
            return $this->format($result, $condition);
        }
        return $result;
    }

    /**
     * @param array $condition 控制参数
     * @param array $search 搜索参数
     * @param array $data 更新数据
     * @return int
     * @throws BusinessException
     */
    public function modify(array $condition, array $search, array $data): int
    {
        if (!ArrayHelper::isValidValue($condition, '_origin')) {
            $result = $this->userDao->detail($condition, $search);
            if (empty($result)) {
                throw new BusinessException(UserError::NOT_FOUND());
            }
            $condition['_origin'] = $result;
        }

        $data = $this->validate($condition, $data, false);
        $ret = $this->userDao->modify($condition, $search, $data);
        if (!$ret) {
            throw new BusinessException(UserError::UPDATE_ERROR());
        }
        return $ret;
    }

    /**
     * @param array $condition
     * @param array $search
     * @param string[] $field
     * @return array
     * @throws Throwable
     */
    public function detail(array $condition, array $search, array $field = ['*']): array
    {
        $result = $this->userDao->detail($condition, $search, $field);
        if (empty($result) && !isset($condition['do_not_throw'])) {
            throw new BusinessException(UserError::NOT_FOUND());
        }
        if (ArrayHelper::isValidValue($condition, 'auto_format')) {
            return $this->format($result, $condition);
        }
        return $result;
    }

    /**
     * @param array $condition 控制参数
     * @param array $search
     * @return int
     * @throws BusinessException
     */
    public function remove(array $condition, array $search): int
    {
        $ret = $this->userDao->remove($condition, $search);
        if (!$ret) {
            throw new BusinessException(UserError::DELETE_ERROR());
        }
        return $ret;
    }

    /**
     * @param array $result
     * @param array $condition
     * @return array
     */
    public function format(array $result, array $condition = []): array
    {
        return $result;
    }

    /**
     * @param array $condition
     * @param array $data
     * @param bool $isNew
     * @return array
     */
    public function validate(array $condition, array $data, bool $isNew = true): array
    {
        return $data;
    }
}