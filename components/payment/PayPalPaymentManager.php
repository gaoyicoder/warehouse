<?php
/**
 * Created by PhpStorm.
 * User: gaoyi
 * Date: 05/02/2018
 * Time: 4:34 PM
 */

namespace app\components\payment;

use yii;
use yii\base\Component;
use Omnipay\Omnipay;
use yii\web\BadRequestHttpException;

class PayPalPaymentManager extends Component
{
    /* @var $_gateway \Omnipay\PayPal\RestGateway; */
    private $_gateway;

    public $clientId;
    public $secret;
    public $testMode;
    public $returnUrl;
    public $cancelUrl;

    public function __construct($config) {
        parent::__construct($config);
        /* @var $gateway \Omnipay\PayPal\RestGateway; */
        $gateway = Omnipay::create('PayPal_Rest');
        $gateway->setClientId($this->clientId);
        $gateway->setSecret($this->secret);
        $gateway->setTestMode($this->testMode);
        $this->_gateway = $gateway;
    }

    public function doPayment($totalAmount, $subject) {

        $response = $this->_gateway->purchase(
            array(
                'returnUrl'=>$this->returnUrl,
                'cancelUrl'=>$this->cancelUrl,
                'amount' =>  $totalAmount,
                'currency' => 'USD',
                'Description' => $subject,

            )

        )->send();

        $response->redirect();
    }

    public function analyzeNotify() {

        $paymentId = $_GET['paymentId'];
        $payerId = $_GET['PayerID'];
        $transaction = $this->_gateway->completePurchase(array(
            'payerId'             => $payerId,
            'transactionReference' => $paymentId,
        ));
        try {
            $response = $transaction->send();

            if ($response->isSuccessful()) {
                return $response->getTransactionReference();
            } else {
                return false;
            }
        } catch (\Exception $e) {
            throw new BadRequestHttpException(Yii::t('app/payment','Payment failure.'));
        }

    }
}