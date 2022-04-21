<?php
declare(strict_types=1);

namespace LinkCloud\Fast\Hyperf\Demo\Entity\Response;

use LinkCloud\Fast\Hyperf\Annotations\ArrayType;
use LinkCloud\Fast\Hyperf\Annotations\Api\Property\ApiProperty;
use LinkCloud\Fast\Hyperf\Framework\Entity\Response\BaseListResponse;

class UserListResponse extends BaseListResponse
{
    #[ApiProperty('列表')]
    #[ArrayType(valueType: UserItem::class)]
    public array $list;
}