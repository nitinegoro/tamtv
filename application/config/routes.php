<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* STATIC ROUTE */
$route['live'] = 'main/live';

$route['search'] = 'main/search';

$route['terbaru'] = 'main/terbaru';

$route['regional'] = 'main/regional';

$route['photo'] = 'main/photo';

$route['video'] = 'main/video';

$route['rekomendasi'] = 'main/rekomendasi';

$route['signup'] = 'login/signup';

$route['comments/submit'] = 'main/set_comment';

$route['me/change_password'] = 'account/change_password';

$route['administrator'] = 'administrator/administrator';

/**
 * Generate Route SEO Freindly
 * Inspiriration from
 * @see https://osvaldas.info/smart-database-driven-routing-in-codeigniter
 **/

require_once( BASEPATH .'database/DB.php' );

$db =& DB();

$permalink = $db->get_where('options', array('option_name' => 'permalink'))->row('option_value');

foreach( $db->get_where( 'posts', array('post_status' => 'publish', 'post_type !=' => 'page') )->result() as $row )
{
	$date = new DateTime($row->post_date);
	switch ($permalink) 
	{
		case 'slug':
			$route[ $row->post_slug ]   = 'main/getpost/';
			break;
		case 'date':
			$route[ $date->format('Y') . '/' . $date->format('m') . '/' . $date->format('d') . '/' . $row->post_slug ]   = 'main/getpost/';
			break;
		case 'month':
			$route[ $date->format('Y') . '/' . $date->format('m') . '/' . $row->post_slug ]   = 'main/getpost/';
			break;
		default:
			$route[ 'read/'.$row->ID . '/' . $row->post_slug ]   = 'main/getpost/';
			break;
	}
}

foreach( $db->get_where( 'posts', array('post_status' => 'publish', 'post_type =' => 'page') )->result() as $row )
	$route['page/' . $row->post_slug ] = 'main/page/';

foreach( $db->get('categories')->result() as $row)
	$route['kategori/' . $row->slug ] = 'main/getcategory/';

foreach( $db->get('tags')->result() as $row)
	$route['tag/' . $row->slug ] = 'main/gettag/';


/* USER ROUTE */
foreach( $db->get_where('users', array('user_type' => 'reader'))->result() as $row)
	$route['me/' . $row->username ] = 'account';