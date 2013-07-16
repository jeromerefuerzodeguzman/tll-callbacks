<?php

class Base_Controller extends Controller {

	public function __construct()
	{
	        //styles
                Asset::add('main_style', 'css/main.css');
                Asset::add('foundation_style', 'css/foundation.min.css');
                Asset::add('normalize', 'css/normalize.css');
                Asset::add('dialog_box_css', 'css/dialog_box.css');
                Asset::add('datepicker_css', 'css/datepicker.css');

                //scripts
                Asset::add('dialog_box_js1', 'js/dialog_box/dialog_plugin.js');
                Asset::add('dialog_box_js2', 'js/dialog_box/dialog_plugin2.js');
                Asset::add('foundation_script', 'js/foundation.min.js');
                Asset::add('foundation_topbar', 'js/foundation/foundation.topbar.js');
                Asset::add('foundation_topbar', 'js/vendor/zepto.js');
                Asset::add('foundation_topbar', 'js/vendor/custom.modernizr.js');
                Asset::add('main_script', 'js/main.js');
                Asset::add('datepicker_js', 'js/datepicker/datepicker.js');
                
        }

        //converts data from class to array
        public function convert_to_array($list) {
                $holder = array('' => '');
                foreach ($list as $type) {
                        $holder[$type->id] = $type->name;
                }
                return $holder;
        }
}