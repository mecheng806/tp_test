<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Gifts extends Model{
	public function show_gift($id,$game_id){
		//$res=Db::table('gifts')->where('id','>',$id)->where('game_id',$game_id)->select();
		$gift = new Gifts();
		$res = $gift -> where('id','>',$id) -> where('game_id',$game_id)->select();
        return $res;
	}
} 