<?php
// Stay Gold additional setting
/*WordPress Menus API.*/
function add_new_menu_items()
{
	//add a new menu item. This is a top level menu item i.e., this menu item can have sub menus
	add_menu_page(
		"Stay Gold Options", //Required. Text in browser title bar when the page associated with this menu item is displayed.
		"stay_gold", //Required. Text to be displayed in the menu.
		"manage_options", //Required. The required capability of users to access this menu item.
		"theme-options", //Required. A unique identifier to identify this menu item.
		"theme_options_page", //Optional. This callback outputs the content of the page associated with this menu item.
		"", //Optional. The URL to the menu item icon.
		100 //Optional. Position of the menu item in the menu.
	);
}

function theme_options_page()
{
	?>
		<div class="wrap">
		<h1>Stay Gold Options</h1>
		<form method="post" action="options.php">
			<?php

				//add_settings_section callback is displayed here. For every new section we need to call settings_fields.
				settings_fields("header_section");

				// all the add_settings_field callbacks is displayed here
				do_settings_sections("theme-options");

				// Add the submit button to serialize the options
				submit_button(); 
			?>
		</form>
	</div>
	<?php
}

//this action callback is triggered when wordpress is ready to add new items to menu.
add_action("admin_menu", "add_new_menu_items");

/*WordPress Settings API Stay Gold*/

function display_options()
{
	//section name, display name, callback to print description of section, page to which section is attached.
	add_settings_section("header_section", "Brand Options", "display_header_options_content", "theme-options");
	
	//setting name, display name, callback to print form element, page in which field is displayed, section to which it belongs.
	//last field section is optional.
	add_settings_field("established", "Established", "display_established_element", "theme-options", "header_section");
	add_settings_field("copyright", "Copyright", "display_copyright_element", "theme-options", "header_section");
	add_settings_field("contact_phone", "Contact Phone", "display_contact_phone_element", "theme-options", "header_section");
	add_settings_field("logo_letter", "Logo Letter", "display_logo_letter_element", "theme-options", "header_section");

	//section name, form element name, callback for sanitization
	register_setting("header_section", "established");
	register_setting("header_section", "copyright");
	register_setting("header_section", "contact_phone");
	register_setting("header_section", "logo_letter");
}

function display_header_options_content(){echo "Add some details";}

function display_established_element()
{
	//id and name of form element should be same as the setting name.
	?>
		<input type="text" name="established" id="established" value="<?php echo get_option('established'); ?>" />
	<?php
}
function display_copyright_element()
{
	//id and name of form element should be same as the setting name.
	?>
		<input type="checkbox" name="copyright" id="copyright" <?php if(get_option('copyright') == 'on'){ ?> checked <?php } ?> />
	<?php
}
 function display_contact_phone_element()
{
	//id and name of form element should be same as the setting name.
	?>
		<input type="text" name="contact_phone" id="contact_phone" value="<?php echo get_option('contact_phone'); ?>" />
	<?php
}
function display_logo_letter_element()
{
	//id and name of form element should be same as the setting name.
	?>
		<input type="text" name="logo_letter" id="logo_letter" value="<?php echo get_option('logo_letter'); ?>" />
	<?php
}

//this action is executed after loads its core, after registering all actions, finds out what page to execute and before producing the actual output(before calling any action callback)
add_action("admin_init", "display_options");

// sub menu pages
function theme_options_panel(){  
  add_submenu_page( 
	  'theme-options', //parent_slug
	  'Home Options', //page_title
	  'Home Options', // menu_title
	  'manage_options', // capability
	  'home-settings', // menu_slug
	  'home_options_page' // function
  );
  add_submenu_page( 'theme-options', 'FAQ', 'FAQ', 'manage_options', 'stay_gold-faq', 'stay_gold_faq_page');
}
// then hook them up
add_action('admin_menu', 'theme_options_panel');

// content for the sub pages
function home_options_page()
{
	?>
		<div class="wrap">
		<h1>Home Options</h1>        
			<form method="post" action="options.php">
				<?php
	
				//add_settings_section callback is displayed here. For every new section we need to call settings_fields.
				settings_fields("home_1_section");

				// all the add_settings_field callbacks is displayed here
				do_settings_sections("home_1-options");

				// Add the submit button to serialize the options
				submit_button(); 
			?>                
		</form>
	</div>
<?php }

// build the settings
function home_options()
{
	add_settings_section(
		"home_1_section", //section name
		"Home Options", // display name
		"home_1_content", // callback to print description of section
		"home-settings" // page to which section is attached.
	);
	
	add_settings_field(
		"home_1", //setting name
		"Home 1", // display name
		"display_home_1_element", //callback to print form element
		"home-settings", // page in which field is displayed
		"home_1_section" // section to which it belongs
	);

	register_setting(
		"home_1_section", //section name
		"home_1" // form element name, callback for sanitization
	);
}

function home_1_content(){echo "Add some details";}
function display_home_1_element()
{
	//id and name of form element should be same as the setting name.
	?>
		<input type="text" name="home_1" id="home_1" value="<?php echo get_option('home_1'); ?>" />
	<?php
}

//this action is executed after loads its core, after registering all actions, finds out what page to execute and before producing the actual output(before calling any action callback)
add_action("admin_init", "home_options");

// content for the sub pages
function stay_gold_faq_page()
{ ?>
	<div class="wrap">
		<h1>FAQ</h1>
		<p>Theme development by Stay Gold Design Club.</p>
	</div>
<?php }