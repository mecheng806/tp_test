<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\User;
use think\cache\driver\Redis;
class Show extends Controller
{
    // protected $redis;

    // public function __construct(){
    //     $this->redis = new Redis();
    //     //$this->redis->connect('127.0.0.1','6379');
    // }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    { 
        // $id = 1;
        // $user = new User();
        // $list = $user->show_data($id);
        //$this -> assign('list',$list);
        return $this -> fetch('index');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function save_redis()
    {   $redis = new Redis();
        $data = serialize(input('post.'));
        $redis->rpush('userinfo_list',$data);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = input('post.');
        $data['ctime'] = time();
        $data['passowrd'] = md5($data['password']);
        $user = new User();
        $user_id = $user->save_data($data);
        return $user_id;

        
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read()
    {
        //向user表中插入数据
        $redis = new Redis();
        while ($data = $redis -> lpop('userinfo_list')) {
            $data = unserialize($data);
            $user = new User();
            $user->save_data($data);
        }
        //var_dump(unserialize($data));
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit()
    {
        $data = input('post.');
        $data['ctime'] = time();
        $user = new User();
        $user -> edit_data($data);
        $list = $user -> show_data($data['id']);
        return $list;

    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
