<?php
/**
 * Copyright PrestashopAddon.com - Updated by Arnaud Favier <arnaudfavier.com>
 * Email: contact@prestashopaddon.com
 * First created: 27/11/2015
 * Last updated: 11/04/2020
*/
if (!defined('_PS_VERSION_'))
	exit;
/**
 * Includes 
 */   
class Ybc_productimagehover extends Module
{    
    private $_hooks = array('productImageHover','displayHeader');
    public function __construct()
	{
		$this->name = 'ybc_productimagehover';
		$this->tab = 'front_office_features';
		$this->version = '1.2.0';
		$this->author = 'PrestashopAddon.com ArnaudFavier.com';
		$this->need_instance = 0;
		$this->secure_key = Tools::encrypt($this->name);
		$this->bootstrap = true;

		parent::__construct();

		$this->displayName = $this->l('Product image rollover');
		$this->description = $this->l('Display second image when hover over product image');
		$this->ps_versions_compliancy = array('min' => '1.7.0.0', 'max' => _PS_VERSION_);        
    }
     /**
	 * @see Module::install()
	 */
    public function install()
	{
	    $res = parent::install();        
        foreach($this->_hooks as $hook)
        {
            $res &= $this->registerHook($hook);
        }  
        Configuration::updateValue('YBC_PI_TRANSITION_EFFECT','faded');
        return  $res;
    }
    /**
	 * @see Module::uninstall()
	 */
	public function uninstall()
	{
	    Configuration::deleteByName('YBC_PI_TRANSITION_EFFECT');
        return parent::uninstall();
    }
    public function hookDisplayHeader()
    { 
        $this->context->controller->addCSS($this->_path.'css/productimagehover.css', 'all');        
    }
    public function getContent()
    {
        if(Tools::isSubmit('submitUpdate'))
        {
            Configuration::updateValue('YBC_PI_TRANSITION_EFFECT', strtolower(trim(Tools::getValue('YBC_PI_TRANSITION_EFFECT'))));
        }
        if(version_compare(_PS_VERSION_, '1.6.0', '>='))
            $postUrl = $this->context->link->getAdminLink('AdminModules', true).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        else
            $postUrl = AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules');
        
        $this->smarty->assign(            
            array(
                'postUrl' => $postUrl,
                'effects' => array(
                    array(
                        'id' => 'zoom',
                        'name' => $this->l('Zoom')
                    ),
                    array(
                        'id' => 'faded',
                        'name' => $this->l('Faded')
                    )/*,
                    array(
                        'id' => 'vertical_scrolling_bottom_to_top',
                        'name' => $this->l('Vertical Scrolling  Bottom To Top')
                    ),
                    array(
                        'id' => 'vertical_scrolling_top_to_bottom',
                        'name' => $this->l('Vertical Scrolling Top To Bottom')
                    ),                    
                    array(
                        'id' => 'horizontal_scrolling_left_to_right',
                        'name' => $this->l('Horizontal Scrolling Left To Right')
                    ),
                    array(
                        'id' => 'horizontal_scrolling_right_to_left',
                        'name' => $this->l('Horizontal Scrolling Right To Left')
                    )*/
                ),
                'YBC_PI_TRANSITION_EFFECT' => Configuration::get('YBC_PI_TRANSITION_EFFECT'),
                'setting_updated' => Tools::isSubmit('submitUpdate') ? true : false,
            )
        );        
        return $this->display(__FILE__, 'admin-config.tpl');
    }
    public function hookProductImageHover($params)
    { 
        if(isset($params['id_product']))
        {
            $product_id=$params['id_product'];
            $sql= "SELECT id_image 
                   FROM  `"._DB_PREFIX_."image` 
                   WHERE  `id_product` =  $product_id AND (cover = 0 OR cover is null) ORDER BY  `position` ASC";
                   
            $image = Db::getInstance()->getRow($sql);
            
            if(!$image)
            {
                $sql= "SELECT id_image 
                       FROM  `"._DB_PREFIX_."image` 
                       WHERE  `id_product` =  $product_id AND cover =  1 ORDER BY  `position` ASC";
                $image = Db::getInstance()->getRow($sql);               
            }
            if($image){
                $product = new Product($product_id,false,$this->context->language->id,$this->context->shop->id);
                
                $this->smarty->assign(array(
                    'product_name' => $product->name,
                    'img_url' => $this->context->link->getImageLink($product->link_rewrite, (int)$image['id_image'], 'home_default')
                ));               
            }
            else
                return;        
        }
        $this->smarty->assign(array('YBC_PI_TRANSITION_EFFECT' => Configuration::get('YBC_PI_TRANSITION_EFFECT')));
        return $this->display(__FILE__, 'image.tpl');
    }
}