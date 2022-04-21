<?php
declare(strict_types=1);

namespace LinkCloud\Fast\Hyperf\Demo\Entity\Request;

use LinkCloud\Fast\Hyperf\Demo\Entity\Request\UserCondition;
use LinkCloud\Fast\Hyperf\Demo\Entity\Request\UserSearch;
use LinkCloud\Fast\Hyperf\Annotations\Api\Property\ApiProperty;
use LinkCloud\Fast\Hyperf\Framework\Entity\BaseRequest;

class UserDetailRequest extends BaseRequest
{
    #[ApiProperty('控制参数')]
    public UserCondition $condition;

    #[ApiProperty('搜索参数')]
    public UserSearch $search;
}