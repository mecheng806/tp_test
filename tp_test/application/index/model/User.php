<?php

namespace app\index\model;

use think\Model;

class User extends Model
{
    public function save_data($data){
    	$user = new User($data);
    	$user->data($data);
    	$user->allowField(true)->save();
    	return $user->id;
    }
    public function show_data($id){
    	$user = new User();
    	$data = $user -> where('id',$id) -> find();
    	//$data = User::get($id);
    	return $data;
    }
    public function edit_data($data){
    	$id = $data['id'];
    	$user = new User();
    	$user -> allowField(['username','password','email','ctime']) -> save($data,['id'=>$id]);
    }
}
