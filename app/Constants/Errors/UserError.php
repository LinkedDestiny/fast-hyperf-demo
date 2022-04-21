<?php
declare(strict_types=1);

namespace LinkCloud\Fast\Hyperf\Demo\Constants\Errors;

use LinkCloud\Fast\Hyperf\Annotations\EnumMessage;
use LinkCloud\Fast\Hyperf\Framework\Entity\ErrorCode;

/**
 * @method static UserError CREATE_ERROR()
 * @method static UserError UPDATE_ERROR()
 * @method static UserError DELETE_ERROR()
 * @method static UserError NOT_FOUND()
 * @method static UserError EXISTS()
 */
class UserError extends ErrorCode
{
    #[EnumMessage(message: "创建用户失败")]
    const CREATE_ERROR = 01;

    #[EnumMessage(message: "更新用户失败")]
    const UPDATE_ERROR = 02;

    #[EnumMessage(message: "删除用户失败")]
    const DELETE_ERROR = 03;

    #[EnumMessage(message: "用户不存在，请重试")]
    const NOT_FOUND = 04;

    #[EnumMessage(message: "用户数据已被占用")]
    const EXISTS = 05;
}