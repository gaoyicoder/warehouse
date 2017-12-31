<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 12/19/17
 * Time: 4:44 PM
 */

namespace app\components\payment;


use yii\base\Component;
use Omnipay\Omnipay;
use Yii;

class AliPaymentManager extends Component
{
    /* @var $_gateway \Omnipay\Alipay\AopPageGateway */
    private $_gateway;

    public $environment;
    public $signType;
    public $appId;
    public $appPrivateKey;
    public $aliPublicKey;
    public $returnUrl;
    public $notifyUrl;

    public function __construct($config) {
        parent::__construct($config);
        /* @var $gateway \Omnipay\Alipay\AopPageGateway */
        $gateway = Omnipay::create('Alipay_AopPage');
        $gateway->setEnvironment($this->environment);
        $gateway->setSignType($this->signType); //RSA/RSA2
        $gateway->setAppId($this->appId);
        $gateway->setPrivateKey($this->appPrivateKey);
        $gateway->setAlipayPublicKey($this->aliPublicKey);
        $gateway->setReturnUrl($this->returnUrl);
        $gateway->setNotifyUrl($this->notifyUrl);
        $this->_gateway = $gateway;
    }

    public function doPayment($orderNumber, $totalAmount, $subject) {
        /* @var $request \Omnipay\Alipay\Requests\AbstractAopRequest */
        $request = $this->_gateway->purchase();
        $request->setBizContent([
            'out_trade_no' => $orderNumber,
            'total_amount' => $totalAmount,
            'subject'      => $subject,
            'product_code' => 'FAST_INSTANT_TRADE_PAY',
        ]);

        /* @var $response \Omnipay\Common\Message\RedirectResponseInterface */
        $response = $request->send();

        $response->redirect();
    }
}