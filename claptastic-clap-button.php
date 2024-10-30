<?php
/*
Plugin name: Claptastic clap! Button
Version: 1.0
Plugin URI: http://claptastic.appspot.com/
Description: Integrates the Claptastic clap! button into your blog giving people an easy way to applaud your content.
Author: Ryan Scott
Author URI: http://henzabits.net/
*/

/*  Copyright 2009  Ryan Scott  (email : scotly [a t] gmail [d o t] com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!class_exists("ClaptasticClapButtonPlugin")) {
	class ClaptasticClapButtonPlugin {
		var $adminOptionsName = "ClaptasticClapButtonPluginAdminOptions";
		function ClaptasticClapButtonPlugin() {
			
		}
		function init() {
			$this->getAdminOptions();
		}

		function getDefaultOptions() {
			$ccb_AdminOptions = array('fontsize' => '1em', 'position' => 'bottomright', 'paddingrightleft' => '10px');
		
			return $ccb_AdminOptions;
		}
		
		//Returns an array of admin options
		function getAdminOptions() {
			$ccb_AdminOptions = $this->getDefaultOptions();
			$ccbOptions = get_option($this->adminOptionsName);
			if (!empty($ccbOptions)) {
				foreach ($ccbOptions as $key => $option)
					$ccb_AdminOptions[$key] = $option;
			}				
			update_option($this->adminOptionsName, $ccb_AdminOptions);
		
			return $ccb_AdminOptions;
		}
		
		function setAdminOptions($newAdminOptions) {
			update_option($this->adminOptionsName, $newAdminOptions);
		}



		function addinCCB($content) {
			$ccbOptions = $this->getAdminOptions();
			$theccbcode = '<script src="http://claptastic.appspot.com/clapengine?v=1.0" type="text/javascript"></script>';
        	
        	$ccbfontsize = $ccbOptions['fontsize'];
        	$ccbpaddingrightleft = $ccbOptions['paddingrightleft'];
        	
        	if($ccbOptions['position'] == 'topleft') {
        		$ccbaddition = '<div id="ccbplugindiv" style="text-align:left;font-size:'.$ccbfontsize.';">'.$theccbcode.'</div>';
        		$content = $ccbaddition.$content;
        	}
        	elseif($ccbOptions['position'] == 'topright') {
        		$ccbaddition = '<div id="ccbplugindiv" style="text-align:right;font-size:'.$ccbfontsize.';">'.$theccbcode.'</div>';
        		$content = $ccbaddition.$content;
        	}
        	elseif($ccbOptions['position'] == 'bottomleft') {
        		$ccbaddition = '<div id="ccbplugindiv" style="text-align:left;font-size:'.$ccbfontsize.';">'.$theccbcode.'</div>';
        		$content = $content.$ccbaddition;
        	}
        	elseif($ccbOptions['position'] == 'bottomright') {
        		$ccbaddition = '<div id="ccbplugindiv" style="text-align:right;font-size:'.$ccbfontsize.';">'.$theccbcode.'</div>';
        		$content = $content.$ccbaddition;
        	}
        	elseif($ccbOptions['position'] == 'topcenter') {
        		$ccbaddition = '<div id="ccbplugindiv" style="text-align:center;font-size:'.$ccbfontsize.';">'.$theccbcode.'</div>';
        		$content = $ccbaddition.$content;
        	}
        	elseif($ccbOptions['position'] == 'bottomcenter') {
        		$ccbaddition = '<div id="ccbplugindiv" style="text-align:center;font-size:'.$ccbfontsize.';">'.$theccbcode.'</div>';
        		$content = $content.$ccbaddition;
        	}
        	elseif($ccbOptions['position'] == 'topleftfloat') {
        		$ccbaddition = '<div id="ccbplugindiv" style="float:left;font-size:'.$ccbfontsize.';line-height:'.$ccbfontsize.';padding-right:'.$ccbpaddingrightleft.';">'.$theccbcode.'</div>';
        		$content = $ccbaddition.$content;
        	}
        	elseif($ccbOptions['position'] == 'toprightfloat') {
        		$ccbaddition = '<div id="ccbplugindiv" style="float:right;font-size:'.$ccbfontsize.';line-height:'.$ccbfontsize.';padding-left:'.$ccbpaddingrightleft.';">'.$theccbcode.'</div>';
        		$content = $ccbaddition.$content;
        	}
        	/*elseif($ccbOptions['position'] == 'bottomleftfloat') {
        		$ccbaddition = '<div id="ccbplugindiv" style="float:left;font-size:'.$ccbfontsize.';">'.$theccbcode.'</div>';
        		$content = $content.$ccbaddition;
        	}
        	elseif($ccbOptions['position'] == 'bottomrightfloat') {
        		$ccbaddition = '<div id="ccbplugindiv" style="float:right;font-size:'.$ccbfontsize.';">'.$theccbcode.'</div>';
        		$content = $content.$ccbaddition;
        	}*/
        	else {
        		$content = $content;
        	}
        	
        	
    		return $content;
		}


		//Prints out the admin page
		function printAdminPage() {
					$ccbOptions = $this->getAdminOptions();
										
					if (isset($_POST['update_ClaptasticClapButtonPluginSettings'])) { 
						if (isset($_POST['ccb_fontsize'])) {
							$ccbOptions['fontsize'] = $_POST['ccb_fontsize'];
						}
						if (isset($_POST['ccb_position'])) {
							$ccbOptions['position'] = $_POST['ccb_position'];
						}
						if (isset($_POST['ccb_paddingrightleft'])) {
							$ccbOptions['paddingrightleft'] = $_POST['ccb_paddingrightleft'];
						}
						update_option($this->adminOptionsName, $ccbOptions);
						
						?>
<div class="updated"><p><strong><?php _e("Claptastic Clap! Button Settings Updated.", "ClaptasticClapButtonPlugin");?></strong></p></div>
					<?php
					} ?>

<div class=wrap>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
<h2>Claptastic Clap! Button Plugin</h2>
<p>That's it. You've given your readers a way to applaud you. Now go write something worth applauding! If you like, you can now check out <a target="_blank" href="http://claptastic.appspot.com/">the Claptastic website</a> to see how your posts are ranking.</p>
<h3>Font Size</h3>
<p>The font size determines how big your button is going to be. The input box accepts standard CSS font size formats, e.g. 16px, 1.2em, 0.5em, smaller, larger, 120%, 50%, etc. The default is 1em, which matches the surrounding text. (See <a href="http://www.w3schools.com/CSS/pr_font_font-size.asp">here</a> and <a href="http://www.w3schools.com/CSS/css_font.asp">here</a> for more on font sizes.)</p>
<input type="text" name="ccb_fontsize" value="<?php _e($ccbOptions['fontsize'], 'ClaptasticClapButtonPlugin') ?>"></input>

<h3>Position</h3>
<div style="width:100%;display:block;height:100px;">
	<div style="float:left;width:200px;">
		<label for="position_topleft"><input type="radio" id="position_topleft" name="ccb_position" value="topleft" <?php if ($ccbOptions['position'] == "topleft") { _e('checked="checked"', "ClaptasticClapButtonPlugin"); }?> /> Top Left</label>
		<br>
		<label for="position_topright"><input type="radio" id="position_topright" name="ccb_position" value="topright" <?php if ($ccbOptions['position'] == "topright") { _e('checked="checked"', "ClaptasticClapButtonPlugin"); }?>/> Top Right</label>
		<br>
		<label for="position_bottomleft"><input type="radio" id="position_bottomleft" name="ccb_position" value="bottomleft" <?php if ($ccbOptions['position'] == "bottomleft") { _e('checked="checked"', "ClaptasticClapButtonPlugin"); }?>/> Bottom Left</label>
		<br>
		<label for="position_bottomright"><input type="radio" id="position_bottomright" name="ccb_position" value="bottomright" <?php if ($ccbOptions['position'] == "bottomright") { _e('checked="checked"', "ClaptasticClapButtonPlugin"); }?>/> Bottom Right</label>
	</div>
	
	<div style="float:left;width:200px;">
		<label for="position_topcenter"><input type="radio" id="position_topcenter" name="ccb_position" value="topcenter" <?php if ($ccbOptions['position'] == "topcenter") { _e('checked="checked"', "ClaptasticClapButtonPlugin"); }?>/> Top Center</label>
		<br>
		<label for="position_bottomcenter"><input type="radio" id="position_bottomcenter" name="ccb_position" value="bottomcenter" <?php if ($ccbOptions['position'] == "bottomcenter") { _e('checked="checked"', "ClaptasticClapButtonPlugin"); }?>/> Bottom Center</label>
	</div>
	
	<div style="float:left;width:200px;">
		<label for="position_topleftfloat"><input type="radio" id="position_topleftfloat" name="ccb_position" value="topleftfloat" <?php if ($ccbOptions['position'] == "topleftfloat") { _e('checked="checked"', "ClaptasticClapButtonPlugin"); }?>/> Top Left Float</label>
		<br>
		<label for="position_toprightfloat"><input type="radio" id="position_toprightfloat" name="ccb_position" value="toprightfloat" <?php if ($ccbOptions['position'] == "toprightfloat") { _e('checked="checked"', "ClaptasticClapButtonPlugin"); }?>/> Top Right Float</label>
		<br>
		<!--<label for="position_bottomleftfloat"><input type="radio" id="position_bottomleftfloat" name="ccb_position" value="bottomleftfloat" <?php if ($ccbOptions['position'] == "bottomleftfloat") { _e('checked="checked"', "ClaptasticClapButtonPlugin"); }?>/> Bottom Left Float</label>
		<br>
		<label for="position_bottomrightfloat"><input type="radio" id="position_bottomrightfloat" name="ccb_position" value="bottomrightfloat" <?php if ($ccbOptions['position'] == "bottomrightfloat") { _e('checked="checked"', "ClaptasticClapButtonPlugin"); }?>/> Bottom Right Float</label>
		-->
	</div>
</div>


	<h3>Padding</h3>
	<p>This option only comes into play if you've selected one of the float options above. If you selected top left float then this will be the amount of padding on the right side of the button. If you selected right float then the padding is for the left side. The only reason for this option is to put a little space between the button and your text in order to make it blend in better. The default is 10px, but you may use any CSS-compatible unit for padding, e.g. 20px, 2em, etc.</p>
<input type="text" name="ccb_paddingrightleft" value="<?php _e($ccbOptions['paddingrightleft'], 'ClaptasticClapButtonPlugin') ?>"></input>

<div class="submit">
<input type="submit" name="update_ClaptasticClapButtonPluginSettings" value="<?php _e('Update Settings', 'ClaptasticClapButtonPlugin') ?>" /></div>
</form>
<p>For support, check out the <a target="_blank" href="http://claptastic.appspot.com/">Claptastic website</a> or email me, scotly@gmail.com.
 </div>
					<?php
				}//End function printAdminPage()
	
	}

} //End Class ClaptasticClapButtonPlugin



if (class_exists("ClaptasticClapButtonPlugin")) {
	$dl_pluginCCB = new ClaptasticClapButtonPlugin();
}

//Initialize the admin panel
if (!function_exists("ClaptasticClapButtonPlugin_ap")) {
	function ClaptasticClapButtonPlugin_ap() {
		global $dl_pluginCCB;
		if (!isset($dl_pluginCCB)) {
			return;
		}
		if (function_exists('add_options_page')) {
			add_options_page('Claptastic Clap Button', 'Claptastic Clap Button', 9, basename(__FILE__), array(&$dl_pluginCCB, 'printAdminPage'));
		}
	}	
}

//Actions and Filters	
if (isset($dl_pluginCCB)) {
	add_action('admin_menu', 'ClaptasticClapButtonPlugin_ap');
	add_action('claptastic-clap-button/claptastic-clap-button.php',  array(&$dl_pluginCCB, 'init'));
	
	add_filter('the_content', array(&$dl_pluginCCB, 'addinCCB'));
}

?>
