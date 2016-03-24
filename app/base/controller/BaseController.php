<?php

/**
 * 基础控制器
 */

namespace app\base\controller;

class BaseController extends \framework\base\Controller {

	/**
	 * 初始化
	 */
	public function __construct() {

	}

	public static function outFail($code,$msg='no',$data=''){
		exit(json_encode([
			'code'=>$code,
			'msg'=>$msg,
			'data'=>$data
		]));
	}

	public static function outSuccess($data='',$code=200,$msg='ok'){
		exit(json_encode([
			'code'=>$code,
			'msg'=>$msg,
			'data'=>$data
		]));
	}

}