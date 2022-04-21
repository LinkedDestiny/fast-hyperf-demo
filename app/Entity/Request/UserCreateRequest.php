<?php
declare(strict_types=1);

namespace LinkCloud\Fast\Hyperf\Demo\Entity\Request;

use LinkCloud\Fast\Hyperf\Demo\Entity\Request\UserCondition;
use LinkCloud\Fast\Hyperf\Demo\Entity\Request\UserData;
use LinkCloud\Fast\Hyperf\Framework\Entity\BaseRequest;
use LinkCloud\Fast\Hyperf\Annotations\Api\Property\ApiProperty;

class UserCreateRequest extends BaseRequest
{
    #[ApiProperty('控制参数')]
    public UserCondition $condition;

    #[ApiProperty('请求数据')]
    public UserData $data;
}