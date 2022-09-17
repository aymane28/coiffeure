<?php

namespace App\Services;

use App\Entity\Servicetype;

class StripeService
{
        private $privatekey;

        public function __construct()
        {
            if($_ENV['APP_ENV'] === 'dev'){
                $this->privatekey = $_ENV['STRIPE_SECRET_KEY_TEST='];
            }else{
                $this->privatekey = $_ENV['STRIPE_SECRET_KEY_LIVE'];

            }
        }

    /**
     * @param Servicetype $servicetype
     * @return \Stripe\PaymentIntent
     * @throws \Stripe\Exception\ApiErrorException
     */
        public function paymentIntent(Servicetype $servicetype): \Stripe\PaymentIntent
        {
            \Stripe\Stripe::setApiKey($this->privatekey);

            return \Stripe\PaymentIntent::create([
                'amount' => $servicetype->getPrice() * 100,
                'patment_method_types' => ['card']
            ]);
        }

        public function paiment(
            $amount,
            $currency,
            $description,
            array $stripeParameter
        ){
            \Stripe\Stripe::setApiKey(($this->privatekey));
            $payment_intent = null;

            if(isset($stripeParameter['stripeIntentId'])){
                $payment_intent=\Stripe\PaymentIntent::retrieve(($stripeParameter['stripeIntentId']));
            }

            if($stripeParameter['stripeIntentId'] === 'succeeded'){
                //TODO
            }else{
                $payment_intent->cancel();
            }

            return $payment_intent;
        }


    /**
     * @param array $stripeParameter
     * @param Servicetype $servicetype
     * @return \Stripe\PaymentIntent|null
     */
        public function stripe(array $stripeParameter, Servicetype $servicetype){
            return $this->paiment(
                $servicetype->getprice()*100,
                $servicetype->getName(),
                $stripeParameter

            );
        }
}