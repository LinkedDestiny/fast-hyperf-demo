<?php
declare(strict_types=1);

namespace LinkCloud\Fast\Hyperf\Demo\Entity\Request;

use LinkCloud\Fast\Hyperf\Demo\Entity\Request\UserCondition;
use LinkCloud\Fast\Hyperf\Demo\Entity\Request\UserListSearch;
use LinkCloud\Fast\Hyperf\Annotations\Api\Property\ApiProperty;
use LinkCloud\Fast\Hyperf\Framework\Entity\BaseRequest;
use LinkCloud\Fast\Hyperf\Framework\Entity\Page;
use LinkCloud\Fast\Hyperf\Framework\Entity\Request\BaseSort;

class UserListRequest extends BaseRequest
{
    #[ApiProperty('控制参数')]
    public UserCondition $condition;

    #[ApiProperty('搜索参数')]
    public UserListSearch $search;

    #[ApiProperty('分页参数')]
    public Page $page;

    #[ApiProperty('排序参数')]
    public BaseSort $sort;
}