<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Curl;
use App\Spider;

class SpiderController extends Controller {

    /**
     * 匹配正则
     * @var string
     */
    private $pattern = '/(花王|贝亲|笔记本|卡西欧|纸巾|机械.*?键盘|gxg|新百伦|施巴|妙思乐|维达|人字拖|化石)/';

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
        $mgpyh = $this->mgpyh();

        $smzdm = $this->smzdm();

        $huihui = $this->huihui();

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
                    'from' => 'smzdm',
                    'is_send' => 1,
                ];
                if ($spider->add_new($insert_data)) {
                    $mail_rows[] = $insert_data;
                }
            }

		}

        $this->echo_msg('什么值得买', $mail_rows);

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

        $this->echo_msg('买个便宜货', $mail_rows);

        return $mail_rows;
    }

	public function huihui()
	{

        // 这是手机的api接口
        $url = 'http://app.huihui.cn/deals/channel.json';

        $curl = new Curl();
        $content = $curl->get($url);
        $content = json_decode($content->body, true);
        $content = $content['data'];

        $spider = new Spider();
        $mail_rows = [];
        foreach ($content as $k => $v) {
            if ($this->is_match($v['title'])) {
                $id = 'huihui_' . $v['id'];
                $insert_data = [
                    'id' => $id,
                    'title' => $v['title'],
                    'content' => '',
                    'url' => '',
                    'post_at' => date('Y-m-d H:i:s', strtotime($v['pub_time'])),
                    'category' => '',
                    'from' => 'huihui',
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

        $curl = new Curl();
        $content = $curl->get($url);
        $content = json_decode($content->body, true);
        $content = $content['data']['linklist'];

        $spider = new Spider();
        $mail_rows = [];
        foreach ($content as $k => $v) {
            if ($this->is_match($v['title'])) {
                $id = 'meidebi_' . $v['id'];
                $insert_data = [
                    'id' => $id,
                    'title' => $v['title'],
                    'content' => '',
                    'url' => $v['orginurl'],
                    'post_at' => date('Y-m-d H:i:s', $v['createtime']),
                    'category' => $v['categoryname'],
                    'from' => 'meidebi',
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
}
