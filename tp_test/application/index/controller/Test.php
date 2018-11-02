<?php
namespace app\index\controller;
use \think\Request;
use \think\View;
use \app\index\model\Gifts;
class Test{
	public function test1(){
		 $request = Request::instance();
		 echo "<pre>";
		 var_dump($request);
	}
	public function show_gift(){
		$request = Request::instance();
		$data = $request->param();
		$id = $data['id'];
		$game_id = $data['game_id'];
		$gifts = new Gifts();
		$data = $gifts -> show_gift($id,$game_id);
		//var_dump($data);exit;
		$view = new View();
		$view ->assign('data',$data);
		return $view -> fetch('show');
	}
	public function index(){
		return 'my status is ok';
	}
}