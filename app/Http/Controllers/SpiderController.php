<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SpiderController extends Controller {

	public function smzdm()
	{

		$timesort = time() . '00';
		$url = 'http://www.smzdm.com/json_more?timesort=' . $timesort;


		$curl = new \Curl();

		$contents = $curl->get($url);
		$contents = json_decode($contents->body, true);

//		print_r($contents);
		var_dump(preg_match('/[(四川胡椒籽)|(椰汁萃取)]/u', '1111四川胡5椒籽2222'));


		foreach ($contents as $key => $content) {

//			var_dump(preg_match('/[四川胡椒籽|椰汁萃取]{1}/', $content['article_content_all']));

		}

	}

	public function mygpyh(){

		$url = 'http://www.mgpyh.com/get_more/?page=1';

	}

	public function huihui($para)
	{





	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
