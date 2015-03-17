<?php namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index_bak()
	{
		$page_size = setting('page_size');
		
		$articles = \App\Article::with('tags', 'category')->latest()->take($page_size)->get();

		return view('home.index',compact('articles'));
	}

	public function index()
	{
		$page_size = setting('page_size');

		$articles = \App\Article::with('tags', 'category')->latest()->take($page_size)->get();

		return view('posts.index',compact('articles'));
	}

	public function about(){
		return view('blog.about');
	}

	public function sns_get_login(){
		$config = array(
			'akey' => '101200316',
			'skey' => 'e631457c8dbcdd6cde691c0bbc7e9565',
			'scope' => 'email,friendships_groups_read',
		);
		$oauth = new \ZenAPI\QqOAuth2($config['akey'], $config['skey']);  //初始化oauth
		$params = array(
			'client_id' => $config['akey'],
			'redirect_uri'  => 'new-blog.app/sns_login',//设置回调
			'response_type' => 'code',
			'state'     => 'made by md5 avoid crsf',
			'display'   => null,
			'scope'     => $config['scope'],
			'forcelogin'    => 0, //是否使用已登陆微博账号
		);
		$authorizeUrl = $oauth->authorizeURL() . "?" . http_build_query($params);
		return redirect($authorizeUrl);
	}

	public function sns_login(){

		$config = [
			'grant_type' => 'authorization_code',
			'client_id' => '101200316',
			'client_secret'=>'e631457c8dbcdd6cde691c0bbc7e9565',
			'code'=>Input::get('code'),
			'redirect_uri'  => 'new-blog.app/sns_login',
		];

		$oauth = new \ZenAPI\QqOAuth2($config['client_id'], $config['client_secret']);  //初始化oauth

		$res = $oauth->http($oauth->accessTokenURL() . '?' . http_build_query($config), 'GET');
		var_dump($res);

		$res = explode('&', $res);


		$data = [];

		foreach ($res as $v) {
			$tmp = explode('=', $v);
			$data[$tmp[0]] = $tmp[1];
		}

		var_dump($data['access_token']);

		dd($oauth->getOpenid($data['access_token']));

		var_dump('111');

		$user_info = $oauth->http($oauth->http('https://graph.qq.com/user/get_user_info?', http_build_query([
			'oauth_consumer_key'=>'100330589',
			'access_token'=>$data['access_token'],
			'openid' =>'3FC6331A5F8253C44EFCF509B5A573B0',
			'format'=>'json'
		])), 'GET');

		var_dump($user_info);
		var_dump('2222');

	}
}
