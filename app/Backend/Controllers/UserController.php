<?php

namespace App\Backend\Controllers;

use App\Mariadb\Backend\BackendUser;
use App\Mariadb\Backend\BackendRole;

class UserController extends Controller {

    public function index() {
        $users = BackendUser::paginate(20);
        return view('backend.user.index', ['users' => $users, 'title' => '用户管理']);
    }

    public function create() {
        return view('backend.user.create', ['title' => '添加用户']);
    }

    public function store() {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'password' => 'required|min:3',
        ]);
        $name = request('name');
        $password = bcrypt(request('password'));
        BackendUser::create(compact('name', 'password'));
        return redirect("/backend/users");
    }

    /**
     * @param  array  $user    
     *   $user变量名称不能随意书写，它依赖（等同）于从路由传过来的参数名称；
     *   在下面方法后面的模型绑定中，BackendUser模型就成功的和$user参数绑定到了一起；
     *   这就是Laravel中借由依赖注入实现的模型绑定。
     * @return array  $roles   取出角色列表中的所有角色；
     * @return array  $myRoles “我”所具有的所有角色；
     * @return array  $user    用户模型；
     * @return string $title   页面标题；
     */
    public function role(BackendUser $user) {
        $roles = BackendRole::all();
        $itsRoles = $user->roles;
        $title = '用户角色管理';
        return view('backend.user.role', compact('roles', 'itsRoles', 'user', 'title'));
    }

    /**
     * 响应POST请求，使用验证器
     * @param array request('roles') 传递后台人员为用户勾选中的角色的id，由于有多个，所以是个数组；
     * @var   array $roles 从角色列表获取到的，该用户将拥有的所有角色；
     * @var   array $itsRoles 该用户本来就有的所有权限；
     * @var   array $plusRoles 用户-权限表中该用户新获得的权限；
     * @var   array $minusRoles 用户-权限表中该用户将失去的权限；
     */
    public function storeRole(BackendUser $user) {
        $this->validate(request(), [
            'roles' => 'required|array'
        ]);

        $roles = BackendRole::findMany(request('roles'));
        $itsRoles = $user->roles;
        $plusRoles = $roles->diff($itsRoles);
        $minusRoles = $itsRoles->diff($roles);

        foreach ($plusRoles as $plusRole) {
            $user->asRole($plusRole);
        }
        foreach ($minusRoles as $minusRole) {
            $user->dimissionRole($minusRole);
        }
        return back();
    }

}
