<?php

/**
 * 默认控制器
 */

namespace app\main\controller;

use app\main\model\DemoModel;
use app\main\model\EdailiModel;
use app\base\controller\BaseController;

/**
 * dashboard 后台主页面
 * Class DefaultController
 * @package app\main\controller
 */
class DefaultController extends BaseController {
	
	/**
	 * 首页
	 */
	public function index() {
		//$this->layout='layout/index';
		$this->title = obj('Demo')->getTitle();
		$this->hello = obj('Demo')->getHello();
		$this->display();
	}

	public function test(){
		$data = (new DemoModel())->find();
		$data = (new DemoModel())->select();
		print_r($data);
		$testData = (new EdailiModel())->select();
		print_r($testData);
		$this->layout='layout';
		(new EdailiModel())->update();
		$this->display();
	}
}