<?php

declare (strict_types=1);
namespace LinkCloud\Fast\Hyperf\Demo\Entity\Traits;

use LinkCloud\Fast\Hyperf\Annotations\Api\Property\ApiProperty;

trait UserIdentifier
{
    
    #[ApiProperty('用户ID')]
    public int $userId;
}