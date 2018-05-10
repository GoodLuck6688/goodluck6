<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use app\common\library\Token;

class Index extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = 'default';

    public function _initialize() {
        parent::_initialize();
    }

    public function index() {

        if ($this->request->isPost()) { //留言入库
            $realname = input('realname');
            $phone = input('phone');
            $remark = input('remark');
            if($realname == ''){
                return json(['code'=>'no','msg'=>'姓名不能为空']);
            }
            if($phone == ''){
                return json(['code'=>'no','msg'=>'手机号不能为空']);
            }
            if(!preg_match('/^1\d{10}$/',$phone)){
                return json(['code'=>'no','msg'=>'手机号格式不正确']);
            }
            $data = ['realname'=>$realname,'phone'=>$phone,'remark'=>$remark,'createtime'=>time(),'updatetime'=>time()];
            $res = model('admin/msg')->insert($data);
            if($res){
                return json(['code'=>'ok','msg'=>'提交成功']);
            }else{
                return json(['code'=>'no','msg'=>'提交失败,请重新提交']);
            }
        }
        $product = getCategoryList('product',0);
        $this->assign('product',$product[0]);

        $five = getCategoryList('Five-in-one',0);
        $this->assign('Fiveinone',$five[0]);
        $fives = getCategoryList('Five-in-one',$five[0]['id']);
        $this->assign('fives',$fives);

        $Advantage = getCategoryList('Advantage',0);
        $this->assign('Advantage',$Advantage[0]);
        $Advantages = getCategoryList('Advantage',$Advantage[0]['id']);
        $this->assign('Advantages',$Advantages);

        $Standard = getCategoryList('Standard',0);
        $this->assign('Standard',$Standard[0]);
        $Standards = getCategoryList('Standard',$Standard[0]['id']);
        $this->assign('Standards',$Standards);

        $page = getCategoryList('company',0);
        $this->assign('company',$page[0]);

        $contactus = getCategoryList('contactus',0);
        $this->assign('contactus',$contactus[0]);

        $article = getCategoryList('article',0);
        $this->assign('article',$article[0]);
        $articles = getCategoryList('article',$article[0]['id'],3);
        $this->assign('articles',$articles);

        return $this->view->fetch();
    }

    // 列表
    public function lists() {
        $c = input('cate','article');
        $this->assign('c',$c);

        $cates = db('category')->where(['pid'=>0,'flag'=>['like','%recommend%']])->select();
        $this->assign('cates',$cates);

        $cate = getCategoryList($c,0);
        $this->assign('cate',$cate[0]);

        $lists = getCategoryList($c,$cate[0]['id'],10,'createtime','DESC');
        $this ->assign('lists',$lists);

        return $this->view->fetch();
    }
    // 详情
    public function detail() {
        $id = input('id');

        $row = db('category')->where(['id'=>$id])->find();
        $this->assign('row',$row);

        $cates = db('category')->where(['pid'=>0,'flag'=>['like','%recommend%']])->select();
        $this->assign('cates',$cates);
        $this->assign('c',$row['type']);

        $cate = getCategoryList($row['type'],0);
        $this->assign('cate',$cate[0]);

        return $this->view->fetch();
    }

    public function news()
    {
        $newslist = [];
        return jsonp(['newslist' => $newslist, 'new' => count($newslist), 'url' => 'https://www.fastadmin.net?ref=news']);
    }
}
