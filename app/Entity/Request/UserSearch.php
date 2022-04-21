<?php
declare(strict_types=1);

namespace LinkCloud\Fast\Hyperf\Demo\Entity\Request;

use LinkCloud\Fast\Hyperf\Demo\Entity\Traits\UserIdentifier;
use LinkCloud\Fast\Hyperf\Annotations\Api\Property\ApiProperty;
use LinkCloud\Fast\Hyperf\Framework\Entity\BaseRequest;

class UserSearch extends BaseRequest
{
    use UserIdentifier;
}