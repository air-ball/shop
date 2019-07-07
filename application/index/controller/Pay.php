<?php
namespace app\index\controller;
use think\Db;
class Pay extends Common
{
    //提交订单
    public function pay(){
        //验证是否登录
        $this->checkLogin(url('check','',true,true));
        //获取购物车列表数据
        $model = model('Order');
        $res = $model ->order(input());
        if($res === false ){
            $this->error($model->getError());
        }
        //$res变量为订单主表内容
        $this->alipay($res);
    }
    public function check(){
        //检查用户登录
        $this->checkLogin(url('cart/index','',true,true));
        
        $data = model('Cart')->getList();
        //检查购物车是否为空
        if(!$data){
            $this->error('亲，您购物车是空的!','index/index');
        }

        $this->assign('data',$data);
        //计算总金额
        $total = model('Cart')->getTotal($data);
        $this->assign('total',$total);
        //计算总数量
        $sum = model('Cart')->getSum($data);
        $this->assign('sum',$sum);
        return $this->fetch();
    }
    //
    public function notifyurl(){
        
        require_once '../extend/alipay/config.php';
        require_once '../extend/alipay/pagepay/service/AlipayTradeService.php';

        $arr=$_POST;
        $alipaySevice = new \AlipayTradeService($config); 
        $alipaySevice->writeLog(var_export($_POST,true));
        $result = $alipaySevice->check($arr);
        if($result){
            //商户订单号

            $out_trade_no = $_POST['out_trade_no'];

            //支付宝交易号

            $trade_no = $_POST['trade_no'];

            //交易状态
            $trade_status = $_POST['trade_status'];
            
            if($_POST['trade_status'] == 'TRADE_FINISHED') {

            }else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {

            }
            echo "success";	
        }else {
                //验证失败
                echo "fail";
            }
    }

    //同步接口
    public function returnurl(){
        require_once("../extend/alipay/config.php");
        require_once '../extend/alipay/pagepay/service/AlipayTradeService.php';


        $arr=$_GET;
        $alipaySevice = new \AlipayTradeService($config); 

        //签名检查
        $result = $alipaySevice->check($arr); 
        if(!$result){
            //验证失败
            return "失败";
        }

        //商户订单号
        $out_trade_no = htmlspecialchars($_GET['out_trade_no']);

        //支付宝交易号
        $trade_no = htmlspecialchars($_GET['trade_no']);

        // 自写 业务逻辑用户支付
        $order_info = db('order')->where('order_sn',$out_trade_no)->find();
        if(!$order_info){
            return 'fail';
        }
        if($order_info['status']==1){
            return '已支付';
        }
        db('order')->where('order_sn',$out_trade_no)->setField('status',1);

        //付款成功页面
        return $this->fetch('pay/succe');
    }
    //alipay 方法
    public function alipay($order){
        require_once '../extend/alipay/config.php';
        require_once '../extend/alipay/pagepay/service/AlipayTradeService.php';
        require_once '../extend/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php';

        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $order['order_sn'];

        //订单名称，必填
        $subject = '商品支付';

        //付款金额，必填
        $total_amount = $_POST['total'];

        //商品描述，可空
        $body = 'ssss';
        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);

        $aop = new \AlipayTradeService($config);

        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
        */
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        file_put_contents('log.txt',$response);
        //输出表单
        var_dump($response);
    }
}