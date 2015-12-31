<?php

class BarclaycardEpdq extends PaymentMethod
{
    
    /**
     * Default background colour for payment pages
     * @config
     */
    private static $default_background = "#ffffff";
    
    /**
     * Default text colour for payment pages
     * @config
     */
    private static $default_text = "#000000";
    
    /**
     * Default table background colour for payment pages
     * @config
     */
    private static $default_table_background = "#ffffff";
    
    /**
     * Default table text colour for payment pages
     * @config
     */
    private static $default_table_text = "#000000";
    
    /**
     * Default button background colour for payment pages
     * @config
     */
    private static $default_button_background = "#4A82BB";
    
    /**
     * Default button text colour for payment pages
     * @config
     */
    private static $default_button_text = "#ffffff";
    
    public static $handler = "BarclaycardEpdqHandler";

    public $Title = 'BarclaycardEpdq';
    
    public $Icon = '';

    private static $db = array(
        "PSPID"           => "Varchar(15)",
        "SHA"             => "Varchar(255)",
        // Theme customisations
        "Background"      => "Varchar(7)",
        "Text"            => "Varchar(7)",
        "TableBackground" => "Varchar(7)",
        "TableText"       => "Varchar(7)",
        "ButtonBackground"=> "Varchar(7)",
        "ButtonText"      => "Varchar(7)"
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        if ($this->ID) {
            $fields->addFieldsToTab(
                "Root.Main",
                array(
                    TextField::create('PSPID')
                        ->setRightTitle(_t("BarclaysEpqd.PSPIDDescription", "Merchant ID with Barclays")),
                    TextField::create('SHA')
                        ->setRightTitle(_t("BarclaysEpqd.SHADescription", "Secure SHA Passcode")),
                    HeaderField::create("ColourCustomisations", _t("BarclaysEpqd.ColourCustomisations", "Colour Customisations")),
                    TextField::create('Background'),
                    TextField::create('Text'),
                    TextField::create('TableBackground'),
                    TextField::create('TableText'),
                    TextField::create('ButtonBackground'),
                    TextField::create('ButtonText'),
                ),
                "Summary"
            );
        }

        return $fields;
    }

    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        
        $config = $this->config();

        // Set default colours
        $this->CallBackSlug = (!$this->CallBackSlug) ? 'epdq' : $this->CallBackSlug;
        
        $this->Background = (!$this->Background) ? $config->default_background : $this->Background;
        $this->Text = (!$this->Text) ? $config->default_text : $this->Text;
        $this->TableBackground = (!$this->TableBackground) ? $config->default_table_background : $this->TableBackground;
        $this->TableText = (!$this->TableText) ? $config->default_table_text : $this->TableText;
        $this->ButtonBackground = (!$this->ButtonBackground) ? $config->default_button_background : $this->ButtonBackground;
        $this->ButtonText = (!$this->ButtonText) ? $config->default_button_text : $this->ButtonText;

        $this->Summary = (!$this->Summary) ? "Pay with credit/debit card securely via Barclays" : $this->Summary;
    }
}
