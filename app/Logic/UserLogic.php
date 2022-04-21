<?php
declare(strict_types=1);

namespace LinkCloud\Fast\Hyperf\Demo\Logic;

use LinkCloud\Fast\Hyperf\Demo\Service\UserService;
use LinkCloud\Fast\Hyperf\Demo\Entity\Response\UserItem;
use LinkCloud\Fast\Hyperf\Framework\BaseLogic;
use LinkCloud\Fast\Hyperf\Framework\Entity\Page;
use LinkCloud\Fast\Hyperf\Framework\Exception\BusinessException;
use LinkCloud\Fast\Hyperf\Framework\UuidGenerator;
use Hyperf\Di\Annotation\Inject;
use Throwable;

class UserLogic extends BaseLogic
{
    #[Inject]
    protected UserService $userService;

    #[Inject]
    protected UuidGenerator $uuidGenerator;

    /**
     * @param array $condition
     * @param array $search
     * @param array $sort
     * @param Page $page
     * @return array
     */
    public function getList(array $condition, array $search, array $sort, Page $page): array
    {
        $condition['auto_format'] = 1;
        return $this->userService->getList($condition, $search, $sort, $page, UserItem::getAllProperty());
    }

    /**
     * @param array $condition
     * @param array $data
     * @return array
     * @throws BusinessException
     */
    public function create(array $condition, array $data): array
    {
        $data['user_id'] = $this->uuidGenerator->generate();
        return $this->userService->create($condition, $data);
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
        return $this->userService->modify($condition, $search, $data);
    }

    /**
     * @param array $condition 控制参数
     * @param array $search
     * @return int
     * @throws BusinessException
     */
    public function remove(array $condition, array $search): int
    {
        return $this->userService->remove($condition, $search);
    }

    /**
     * @param array $condition
     * @param array $search
     * @return array
     * @throws Throwable
     */
    public function detail(array $condition, array $search): array
    {
        $condition['auto_format'] = 1;
        return $this->userService->detail($condition, $search, UserItem::getAllProperty());
    }
}