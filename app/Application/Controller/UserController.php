<?php
declare(strict_types=1);

namespace LinkCloud\Fast\Hyperf\Demo\Application\Controller;

use LinkCloud\Fast\Hyperf\Demo\Logic\UserLogic;
use LinkCloud\Fast\Hyperf\Demo\Entity\Request\UserCreateRequest;
use LinkCloud\Fast\Hyperf\Demo\Entity\Request\UserModifyRequest;
use LinkCloud\Fast\Hyperf\Demo\Entity\Request\UserRemoveRequest;
use LinkCloud\Fast\Hyperf\Demo\Entity\Request\UserDetailRequest;
use LinkCloud\Fast\Hyperf\Demo\Entity\Request\UserListRequest;
use LinkCloud\Fast\Hyperf\Demo\Entity\Response\UserDetailResponse;
use LinkCloud\Fast\Hyperf\Demo\Entity\Response\UserListResponse;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\PostMapping;
use LinkCloud\Fast\Hyperf\Annotations\Api\Api;
use LinkCloud\Fast\Hyperf\Annotations\Api\ApiHeader;
use LinkCloud\Fast\Hyperf\Annotations\Api\ApiOperation;
use LinkCloud\Fast\Hyperf\Annotations\Api\Request\RequestBody;
use LinkCloud\Fast\Hyperf\Annotations\Api\Request\Valid;
use LinkCloud\Fast\Hyperf\Framework\BaseController;
use LinkCloud\Fast\Hyperf\Framework\Entity\Response\BaseSuccessResponse;
use Throwable;

#[Controller(prefix: "/api/v1/user")]
#[Api(tags: "管理", description: "管理")]
#[ApiHeader(name: 'Authorization')]
class UserController extends BaseController
{
    #[Inject]
    public UserLogic $userLogic;

    #[PostMapping(path: "list")]
    #[ApiOperation("获取列表")]
    public function getList(#[Valid] #[RequestBody] UserListRequest $request): UserListResponse
    {
        $result = $this->userLogic->getList($request->condition->toArray(), $request->search->toArray(), $request->sort->toArray(), $request->page);
        return new UserListResponse($result);
    }

    /**
     * @throws Throwable
     */
    #[PostMapping(path: "create")]
    #[ApiOperation("创建")]
    public function create(#[Valid] #[RequestBody] UserCreateRequest $request): BaseSuccessResponse
    {
        $this->userLogic->create($request->condition->toArray(), $request->data->toArray());
        return new BaseSuccessResponse();
    }

    /**
     * @throws Throwable
     */
    #[PostMapping(path: "modify")]
    #[ApiOperation("更新")]
    public function modify(#[Valid] #[RequestBody] UserModifyRequest $request): BaseSuccessResponse
    {
        $this->userLogic->modify($request->condition->toArray(), $request->search->toArray(), $request->data->toArray());
        return new BaseSuccessResponse();
    }

    /**
     * @throws Throwable
     */
    #[PostMapping(path: "remove")]
    #[ApiOperation("删除")]
    public function remove(#[Valid] #[RequestBody] UserRemoveRequest $request): BaseSuccessResponse
    {
        $this->userLogic->remove($request->condition->toArray(), $request->search->toArray());
        return new BaseSuccessResponse();
    }

    /**
     * @throws Throwable
     */
    #[PostMapping(path: "detail")]
    #[ApiOperation("获取详情")]
    public function detail(#[Valid] #[RequestBody] UserDetailRequest $request): UserDetailResponse
    {
        $result = $this->userLogic->detail($request->condition->toArray(), $request->search->toArray());
        return new UserDetailResponse($result);
    }
}