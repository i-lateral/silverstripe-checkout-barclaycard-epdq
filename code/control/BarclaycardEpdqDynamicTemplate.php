<?php

class BarclaycardEpdqDynamicTemplate extends Controller
{
    
    private static $allowed_actions = array(
        "index"
    );
    
    public function index()
    {
        $config = SiteConfig::current_site_config();
        
        return $this
            ->customise(array(
                "Config" => $config,
                "Title" => _t("BarclaycardEpdq.TemplateTitle", "Pay for your order via Barclays"),
                "MetaTitle" => _t("BarclaycardEpdq.TemplateTitle", "Pay via Barclays")
            ))->renderWith("BarclaycardEpdqDynamicTemplate");
    }
}
