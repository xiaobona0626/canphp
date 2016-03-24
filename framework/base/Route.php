<?php

/**
 * 路由类
 */

namespace framework\base;

class Route {

	/**
	 * 路由规则
	 * @var array
	 */
	static protected $rewriteRule = array();

	/**
	 * 路由开关
	 * @var boolean
	 */
	static protected $rewriteOn = false;

	/**
	 * 解析URL
	 * @param  array   $rewriteRule 路由规则
	 * @param  boolean $rewriteOn   路由开关
	 * @return void
	 */
	static public function parseUrl( $rewriteRule, $rewriteOn=false) {
		self::$rewriteRule = $rewriteRule;
		self::$rewriteOn = $rewriteOn;
		if( self::$rewriteOn && !empty(self::$rewriteRule ) ) {
			if( ($pos = strpos( $_SERVER['REQUEST_URI'], '?' )) !== false ){
				parse_str( substr( $_SERVER['REQUEST_URI'], $pos + 1 ), $_GET );
			}
			foreach(self::$rewriteRule as $rule => $mapper) {
				$rule = ltrim($rule, "./\\");
				if( false === stripos($rule, 'http://')){
					$rule = $_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER["SCRIPT_NAME"]), '/\\') . '/' . $rule;
				}
				$rule = '/'.str_ireplace(array('\\\\', 'http://', '-', '/', '<', '>',  '.'), array('', '', '\-', '\/', '(?<', ">[a-z0-9_%]+)", '\.'), $rule).'/i';
				if( preg_match($rule, $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], $matches) ){
					foreach($matches as $matchkey => $matchval){
						if(('app' === $matchkey)){
							$mapper = str_ireplace('<app>', $matchval, $mapper);
						}else if('c' === $matchkey){
							$mapper = str_ireplace('<c>', $matchval, $mapper);
						}else if('a' === $matchkey){
							$mapper = str_ireplace('<a>', $matchval, $mapper);
						} else {
							if( !is_int($matchkey) ) $_GET[$matchkey] = $matchval;
						}
					}
					$_REQUEST['r'] = $mapper;
					break;
				}
			}
		}
		
		$routeArr = isset($_REQUEST['r']) ? explode("/", $_REQUEST['r']) : array();
		//$app_name = empty($routeArr[0]) ? Config::get('DEFAULT_APP') : $routeArr[0];
		$app_name = APP_NAME;
		$controller_name = empty($routeArr[0]) ? Config::get('DEFAULT_CONTROLLER') : $routeArr[0];
		$action_name = empty($routeArr[1]) ? Config::get('DEFAULT_ACTION') : $routeArr[1];
		$_REQUEST['r'] = $app_name .'/'. $controller_name .'/'. $action_name;
		
		if( !defined('APP_NAME') ) define('APP_NAME', strtolower($app_name));
		if( !defined('CONTROLLER_NAME') ) define('CONTROLLER_NAME', $controller_name);
		if( !defined('ACTION_NAME') ) define('ACTION_NAME', $action_name);
	}

	/**
	 * 生成URL
	 * @param  string $route  URL路径
	 * @param  array  $params URL参数
	 * @return string
	 */
	static public function url($route=null, $params=array()) {
		$app = APP_NAME;
		$controller = CONTROLLER_NAME;
		$action = ACTION_NAME;
		if($route){
			$route = explode('/', $route, 3);
			$routeNum = count($route);
			switch ($routeNum) {
				case 1:
					$action = $route[0];
					break;
				case 2:
					$controller = $route[0];
					$action = $route[1];
					break;
				case 3:
					$app = $route[0];
					$controller = $route[1];
					$action = $route[2];
					break;
			}
		}
		$route = $app.'/'.$controller.'/'.$action;
		$paramStr = empty($params) ? '' : '&' . http_build_query($params);
		$url = $_SERVER["SCRIPT_NAME"] . '?r=' . $route . $paramStr;
			
		if( self::$rewriteOn && !empty(self::$rewriteRule ) ) {
			static $urlArray = array();
			if( !isset($urlArray[$url]) ){
				foreach(self::$rewriteRule as $rule => $mapper){
					$mapper = '/'.str_ireplace(array('/', '<app>', '<c>', '<a>'), array('\/', '(?<app>\w+)', '(?<c>\w+)', '(?<a>\w+)'), $mapper).'/i';
					if( preg_match($mapper, $route, $matches) ){
						list($app, $controller, $action) = explode('/', $route);
						$urlArray[$url] = str_ireplace(array('<app>', '<c>', '<a>'), array($app, $controller, $action), $rule);
						if( !empty($params) ){
							$_args = array();
							foreach($params as $argkey => $arg){
								$count = 0;
								$urlArray[$url] = str_ireplace('<'.$argkey.'>', $arg, $urlArray[$url], $count);
								if(!$count) $_args[$argkey] = $arg;
							}

							if( !empty($_args) ){
								$urlArray[$url] = preg_replace('/<\w+>/', '', $urlArray[$url]). '?' . http_build_query($_args);
							}	
						}

						if(false === stripos($urlArray[$url], 'http://')){
							$urlArray[$url] = 'http://'.$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER["SCRIPT_NAME"]), "./\\") .'/'.ltrim($urlArray[$url], "./\\");
						}
						
						$rule = str_ireplace(array('<app>', '<c>', '<a>'), '', $rule);
						if( count($params) == preg_match_all('/<\w+>/is', $rule, $_match)){
							return $urlArray[$url];
						}	
					}
				}
				return isset($urlArray[$url]) ? $urlArray[$url] : $url;
			}
			return $urlArray[$url];
		}
		return $url;
	}
}