<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Curl;
use App\Spider;
use Illuminate\Support\Facades\View;

class SpiderController extends Controller {


    private function curl($url, $data=[], $type='get')
    {

        // 初使化一个用curl
        $curl = new Curl();

        // 取得数据
        try{
            $rec = $curl->$type($url, $data);
            return $rec->body;
        }catch (\ErrorException $e){
            print_r($e);
            return array();
        }
    }

    /**
     * 匹配正则
     * @var strin
     */
    private $pattern = '/(花王|贝亲|笔记本|卡西欧|纸巾|机械.*?键盘|gxg|新百伦|施巴|妙思乐|维达|人字拖|化石)/';

    private function is_match($str){

        return true;

        if (preg_match($this->pattern, $str)) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * 发送邮件
     */
    private function send_mail($rows)
    {
        if (!empty($rows)) {
            \Mail::send('emails.goods', array('rows' => $rows), function($message)
            {
//                $message->to('coke_vincent@163.com', 'John Smith')->subject('新商品提醒' . date('Y-m-d H:i:s'));
//                $message->to('362619655@qq.com', 'John Smith')->subject('新商品提醒' . date('Y-m-d H:i:s'));
                $message->to('396840082@qq.com', 'John Smith')->subject('新商品提醒' . date('Y-m-d H:i:s'));
                $message->to('362619655@qq.com', 'John Smith')->subject('新商品提醒' . date('Y-m-d H:i:s'));

            });
        }

    }

    private function echo_msg($name, $data){

        echo $name . ': ' . '<br />';
        print_r($data);
        echo '<br /><hr />';

    }

    public function index(){

        // 总数据
        $mgpyh = [];
        $mgpyh = $this->mgpyh();

        $smzdm = [];
        $smzdm = $this->smzdm();

        $huihui = [];
        $huihui = $this->huihui();

        $meidebi = [];
        $meidebi = $this->meidebi();

        $this->send_mail(array_merge($mgpyh, $smzdm, $huihui, $meidebi));
    }


    public function smzdm()
	{

		$timesort = time() . '00';
		$url = 'http://www.smzdm.com/json_more?timesort=' . $timesort;


		$curl = new Curl();

		$contents = $curl->get($url);
		$contents = json_decode($contents->body, true);

        $spider = new Spider();
        $mail_rows = [];
        foreach ($contents as $key => $v) {

            if ($this->is_match($v['article_content_all'])) {
                $id = 'smzdm_' . $v['article_id'];
                $insert_data = [
                    'id' => $id,
                    'title' => $v['article_title'],
                    'content' => $v['article_content_all'],
                    'url' => $v['article_url'],
                    'post_at' => date('Y-m-d H:i:s', substr($v['timesort'], 0, 10)),
                    'category' => '',
                    'from' => '什么值得买',
                    'is_send' => 1,
                ];
                if ($spider->add_new($insert_data)) {
                    $mail_rows[] = $contents;
                }
            }

		}

        $this->echo_msg('什么值得买', $mail_rows);

        return $mail_rows;

	}

	public function mgpyh(){

		$url = 'http://www.mgpyh.com/get_more';

        $curl = new Curl();
        $content = $curl->get($url);
        $content = json_decode($content->body, true);
        $content = $content['items'];

        $spider = new Spider();
        $mail_rows = [];
        foreach ($content as $k => $v) {
            if ($this->is_match($v['post'])) {
                $id = 'mgpyh_' . $v['id'];
                $insert_data = [
                    'id' => $id,
                    'title' => $v['post_title'],
                    'content' => $v['post'],
                    'url' => 'http://www.mgpyh.com'.$v['post_url'],
                    'post_at' => date('Y-m-d H:i:s', strtotime($v['exact_time'])),
                    'category' => $v['category'],
                    'from' => '买个便宜货',
                    'is_send' => 1,
                ];
                if ($spider->add_new($insert_data)) {
                    $mail_rows[] = $insert_data;
                }
            }
        }

        $this->echo_msg('买个便宜货', $mail_rows);

        return $mail_rows;
    }

	public function huihui()
	{

        // 这是手机的api接口

        // 列表
        $list = 'http://app.huihui.cn/deals/channel.json';
        // 商品详细信息
        $detail = 'http://app.huihui.cn/deals/deal/{id}.json?with_detail=1';

        $curl = new Curl();
        $content = $curl->get($list);
        $content = json_decode($content->body, true);
        $content = $content['data'];

        $spider = new Spider();
        $mail_rows = [];
        foreach ($content as $k => $v) {
            if ($this->is_match($v['title'])) {
                // 取得商品详细信息
                $detail_data = $curl->get(str_replace('{id}', $v['id'], $detail));
                $detail_data = json_decode($detail_data->body, true);
                $detail_data = $detail_data['data'];

                $url = strstr($detail_data['purchase_url'], 'taobao') ?
                        $detail_data['purchase_url'] : urldecode(substr($detail_data['purchase_url'], 12, -8));

                $id = 'huihui_' . $v['id'];
                $insert_data = [
                    'id' => $id,
                    'title' => $v['title'] . $v['sub_title'],
                    'content' => $detail_data['page'],
                    'url' => $url,
                    'post_at' => date('Y-m-d H:i:s', strtotime($v['pub_time'])),
                    'category' => '',
                    'from' => '惠惠',
                    'is_send' => 1,
                ];

                if ($spider->add_new($insert_data)) {
                    $mail_rows[] = $insert_data;
                }
            }
        }

        $this->echo_msg('惠惠', $mail_rows);

        return $mail_rows;


	}

    public function meidebi(){

        // 这是手机的api接口
        $url = 'http://a.meidebi.com/Share-allhotlist?limit=50&p=1';
        // 商品详细信息
        $detail = 'http://a.meidebi.com//Link-linkdesc-linkid-{id}.html';

        $curl = new Curl();
        $content = $curl->get($url);
        $content = json_decode($content->body, true);
        $content = $content['data']['linklist'];

        $spider = new Spider();
        $mail_rows = [];
        foreach ($content as $k => $v) {
            if ($this->is_match($v['title'])) {

                // 取得商品详细信息
                $detail_data = $curl->get(str_replace('{id}', $v['id'], $detail));

                if(preg_match('/<body>([\s\S]*)<\/body>/', $detail_data->body, $match) && isset($match[1]))
                {
                    $detail_content = $match[1];
                } else {
                    $detail_content = '';
                }

                $id = 'meidebi_' . $v['id'];
                $insert_data = [
                    'id' => $id,
                    'title' => $v['title'],
                    'content' => $detail_content,
                    'url' => $v['orginurl'],
                    'post_at' => date('Y-m-d H:i:s', $v['createtime']),
                    'category' => $v['categoryname'],
                    'from' => '没得比',
                    'is_send' => 1,
                ];
                if ($spider->add_new($insert_data)) {
                    $mail_rows[] = $insert_data;
                }
            }
        }

        $this->echo_msg('没得比：', $mail_rows);

        return $mail_rows;

    }


    public function show(){

        $pattern = '花王|贝亲|笔记本|卡西欧|纸巾|机械.*键盘|gxg|新百伦|施巴|妙思乐|维达|人字拖|化石|苏菲';

        $list = Spider::where('title', 'regexp', $pattern)->orderBy('created_at', 'DESC')->paginate(20);

        return View::make('dajuhui.goods', ['articles'=>$list]);
    }


}


