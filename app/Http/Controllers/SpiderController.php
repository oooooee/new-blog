<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Curl;
use App\Spider;

class SpiderController extends Controller {

    /**
     * 匹配正则
     * @var string
     */
    private $pattern = '/(花王|贝亲|笔记本|卡西欧|纸巾|机械.*?键盘|gxg|新百伦)/';

    private function is_match($str){
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
                $message->to('oooooee@qq.com', 'John Smith')->subject('新商品提醒' . date('Y-m-d H:i:s'));
                $message->to('396840082@qq.com', 'John Smith')->subject('新商品提醒' . date('Y-m-d H:i:s'));
            });
        }

    }

    public function index(){

        // 总数据
        $rows = [];

        $mgpyh = $this->mgpyh();

        $smzdm = $this->smzdm();

        $huihui = [];

        $meidebi = [];

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
                    'from' => 'smzdm',
                    'is_send' => 1,
                ];
                if ($spider->add_new($insert_data)) {
                    $mail_rows[] = $insert_data;
                }
            }

		}

        print_r($mail_rows);

        return $mail_rows;

	}

	public function mgpyh(){

		$url = 'http://www.mgpyh.com/get_more/?page=2';

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
                    'url' => $v['post_url'],
                    'post_at' => date('Y-m-d H:i:s', strtotime($v['exact_time'])),
                    'category' => $v['category'],
                    'from' => 'mgpyh',
                    'is_send' => 1,
                ];
                if ($spider->add_new($insert_data)) {
                    $mail_rows[] = $insert_data;
                }
            }
        }
        print_r($mail_rows);

        return $mail_rows;
    }

	public function huihui()
	{

        print_r('c');



	}
}
