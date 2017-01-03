<?php

/**
 * Barclays ePQD intagration for the checkout module
 * 
 * @author ilateral (http://www.ilateral.co.uk)
 */
class BarclaycardEpdqHandler extends PaymentHandler
{

    public function index($request)
    {
        $this->extend('onBeforeIndex');
        
        // Setup payment gateway form
        $site = SiteConfig::current_site_config();
        $order = $this->getOrderData();
        $cart = ShoppingCart::get();
        $pw = $this->payment_gateway->SHA;
        $sha_data = "";
        
        // Setup the gateway URL
        if (Director::isDev()) {
            $gateway_url = "https://mdepayments.epdq.co.uk/ncol/test/orderstandard.asp";
        } else {
            $gateway_url = "https://payments.epdq.co.uk/ncol/prod/orderstandard.asp";
        }

        $success_url = Controller::join_links(
            Director::absoluteBaseURL(),
            Payment_Controller::config()->url_segment,
            'complete',
            $order->OrderNumber
        );

        $error_url = Controller::join_links(
            Director::absoluteBaseURL(),
            Payment_Controller::config()->url_segment,
            'complete',
            'error'
        );

        $back_url = Controller::join_links(
            Director::absoluteBaseURL(),
            Checkout_Controller::config()->url_segment,
            "finish"
        );
        
        $template_url = Controller::join_links(
            Director::absoluteBaseURL(),
            "BarclaycardEpdqDynamicTemplate"
        );
        
        // Get an array of details, so we can generate a hash and convert
        // to hidden fields
        $data = array(
            "PSPID"         => $this->payment_gateway->PSPID,
            
            // Order Details
            "ORDERID"       => $order->OrderNumber,
            "AMOUNT"        => round($cart->TotalCost * 100), // Format price as pence
            "CURRENCY"      => Checkout::config()->currency_code,
            "LANGUAGE"      => i18n::get_locale(),
            "CN"            => $order->FirstName . " " . $order->Surname,
            "EMAIL"         => $order->Email,
            "OWNERADDRESS"  => $order->Address1,
            "OWNERTOWN"     => $order->City,
            "OWNERZIP"      => $order->PostCode,
            "OWNERCTY"      => $order->Country,
            
            // Customisation options
            "TITLE"         => $site->Title,
            "BGCOLOR"       => $this->payment_gateway->Background,
            "TXTCOLOR"      => $this->payment_gateway->Text,
            "TBLBGCOLOR"    => $this->payment_gateway->TableBackground,
            "TBLTXTCOLOR"   => $this->payment_gateway->TableText,
            "BUTTONBGCOLOR" => $this->payment_gateway->ButtonBackground,
            "BUTTONTXTCOLOR"=> $this->payment_gateway->ButtonText,
            
            // Callback URLs
            "ACCEPTURL"     => $success_url,
            "DECLINEURL"    => $error_url,
            "EXCEPTIONURL"  => $error_url,
            "CANCELURL"     => $error_url,
            
            // Custom Template
            "TP"            => $template_url
        );
        
        // Account for the fact the phone number might not be set
        if ($order->PhoneNumber) {
            $data["OWNERTELNO"] = $order->PhoneNumber;
        }

        $fields = FieldList::create();
        
        ksort($data);
        
        // Generate our SHA Key and add fields
        foreach ($data as $k => $v) {
            $fields->push(HiddenField::create($k, null, $v));
            $sha_data .= sprintf("%s=%s%s", $k, $v, $pw);
        }
        
        $hashed_data = strtoupper(hash("sha1", $sha_data));
        
        // Finally add out hashed data
        $fields->push(HiddenField::create("SHASign", null, $hashed_data));

        $actions = FieldList::create(
            LiteralField::create('BackButton', '<a href="' . $back_url . '" class="btn btn-red checkout-action-back">' . _t('Checkout.Back', 'Back') . '</a>'),
            FormAction::create('Submit', _t('Checkout.ConfirmPay', 'Confirm and Pay'))
                ->addExtraClass('btn')
                ->addExtraClass('btn-green')
        );

        $form = Form::create($this, 'Form', $fields, $actions)
            ->addExtraClass('forms')
            ->setFormMethod('POST')
            ->setFormAction($gateway_url);
        
        $this->customise(array(
            "Title"     => _t('Checkout.Summary', "Summary"),
            "MetaTitle" => _t('Checkout.Summary', "Summary"),
            "Form"      => $form,
            "Order"     => $order
        ));
        
        $this->extend("onAfterIndex");
        
        return $this->renderWith(array(
            "BarclaysEpqd",
            "Payment",
            "Checkout",
            "Page"
        ));
    }


    /**
     * Retrieve and process order data from the request
     */
    public function callback($request)
    {
        $this->extend('onBeforeCallback');
        
        $post_data = $this->request->postVars();
        $get_data = $this->request->getVars();
        $data = array_merge($post_data, $get_data);
        $status = "error";
        $order_id = 0;
        $payment_id = 0;

        // Check if CallBack data exists and install id matches the saved ID
        if (
            isset($data) && // Data and order are set
            array_key_exists('STATUS', $data) &&
            array_key_exists('orderID', $data) &&
            array_key_exists('PAYID', $data)
        ) {
            $order_id = $data['orderID'];
            $payment_id = $data['PAYID'];
            
            switch ($data['STATUS']) {
                case "5":
                    $status = "paid";
                    break;
                case "1":
                case "6":
                case "64":
                    $status = "cancelled";
                    break;
                case "84":
                case "93":
                    $status = "failed";
                    break;
                break;
                case "2":
                case "52":
                    $status = "failed";
                    break;
                case "4":
                case "9":
                case "40":
                case "91":
                case "50":
                case "51":
                case "52":
                case "59":
                case "92":
                case "95":
                case "99":
                    $status = "pending";
                    break;
                case "93":
                    $status = "failed";
                    break;
            }
        } else {
            return $this->httpError(500);
        }
        
        $payment_data = ArrayData::array_to_object(array(
            "OrderID" => $order_id,
            "PaymentProvider" => "Barclays EPQD",
            "PaymentID" => $payment_id,
            "Status" => $status,
            "GatewayData" => $data
        ));
        
        $this->setPaymentData($payment_data);
        
        $this->extend('onAfterCallback');
        
        return;
    }
}
