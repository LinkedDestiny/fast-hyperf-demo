<?php

declare (strict_types=1);
namespace LinkCloud\Fast\Hyperf\Demo\Entity\Response;

use LinkCloud\Fast\Hyperf\Annotations\Api\Property\ApiProperty;
use LinkCloud\Fast\Hyperf\Framework\Entity\BaseResponse;

class UserItem extends BaseResponse
{
    
    #[ApiProperty('用户ID')]
    public int $userId;
    
    #[ApiProperty('用户名称')]
    public string $userName;
    
    #[ApiProperty('状态')]
    public int $status;
    
    #[ApiProperty('创建时间')]
    public int $createAt;
    
    #[ApiProperty('更新时间')]
    public int $updateAt;
}