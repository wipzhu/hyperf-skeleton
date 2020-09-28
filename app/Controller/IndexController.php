<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use App\Service\UserService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;

/**
 * Class IndexController
 * @package App\Controller
 */
class IndexController extends AbstractController
{
    /**
     * @Inject()
     * @var UserService
     */
    private $userService;

    /**
     * @return array
     * @author wipzhu
     */
    public function index(RequestInterface $request)
    {
        $user = $request->input('user', 'Hyperf');
        $method = $request->getMethod();

        return [
            'method'  => $method,
            'message' => "Hello {$user}.",
        ];
    }

    /**
     * @param RequestInterface $request
     * @return mixed
     * @author wipzhu
     */
    public function info(RequestInterface $request)
    {
        $id = $request->input('id', 2);
        return $this->userService->getInfoById((int)$id);
    }

    /**
     * @param RequestInterface $request
     * @return mixed
     * @author wipzhu
     */
    public function profile(RequestInterface $request)
    {
        $id = $request->input('id', 1);
        return $this->userService->getInfoById((int)$id);
    }
}
