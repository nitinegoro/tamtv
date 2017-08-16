<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
// Autoload the required files
require_once( FCPATH . 'vendor/facebook/php-sdk-v4/autoload.php' );
 
// Make sure to load the Facebook SDK for PHP via composer or manually
 
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
// add other classes you plan to use, e.g.:
// use Facebook\FacebookRequest;
// use Facebook\GraphUser;
// use Facebook\FacebookRequestException;
 
class Facebook
{
  var $ci;
  var $session = false;
 
  public function __construct()
  {
    // Get CI object.
    $this->ci =& get_instance();

    $this->ci->load->library('session');
 
    // Initialize the SDK
    FacebookSession::setDefaultApplication( $this->ci->config->item('api_id', 'facebook'), $this->ci->config->item('app_secret', 'facebook') );
  }
 
  /**
   * Get FB session.
   */
  public function get_session()
  {
    if ( $this->ci->session->userdata('fb_token') ) {
      // Validate the access_token to make sure it's still valid
      $this->session = new FacebookSession( $this->ci->session->userdata('fb_token') );
      try {
        if ( ! $this->session->validate() ) {
          $this->session = false;
        }
      } catch ( Exception $e ) {
        // Catch any exceptions
        $this->session = false;
      }
    }
    else
    {
      // Add `use Facebook\FacebookRedirectLoginHelper;` to top of file
      $helper = new FacebookRedirectLoginHelper( $this->ci->config->item('redirect_url', 'facebook') );
      try {
        $this->session = $helper->getSessionFromRedirect();
      } catch( FacebookRequestException $ex ) {
        // When Facebook returns an error
        print_r($ex->getResponse());
        //redirect( base_url( 'login?err=' . $ex->getResponse() ) );
      } catch( \Exception $ex ) {
        print_r($ex->getResponse());
        // When validation fails or other local issues
        //redirect( base_url( 'login?err=' . $ex->getResponse() ) );
      }
    }
  }
 
  /**
   * Login functionality.
   */
  public function login()
  {
    $this->get_session();
    if ( $this->session )
    {
      $this->ci->session->set_userdata( 'fb_token', $this->session->getToken() );
 
      $user = $this->get_user();
 
      if ( $user && ! empty( $user['email'] ) )
      {
         $result = $this->ci->user_model->get_user( $user['email'] );
 
          if ( ! $result )
          {
            // Not registered.
            $this->ci->session->set_flashdata( 'fb_user', $user );
            redirect( base_url( 'register' ) );
          }
          else
          {
            if ( $this->ci->user_model->sign_in( $result->username, $result->password ) )
            {
              redirect( base_url( 'home' ) );
            }
            else
            {
              die( 'ERROR' );
              redirect( base_url( 'login' ) );
            }
          }
      }
      else
      {
        die( 'ERROR' );
      }
    }
  }
 
  /**
   * Returns the login URL.
   */
  public function login_url()
  {
    // Add `use Facebook\FacebookRedirectLoginHelper;` to top of file
    $helper = new FacebookRedirectLoginHelper( $this->ci->config->item('redirect_url', 'facebook') );
 
    return $helper->getLoginUrl( $this->ci->config->item('permissions', 'facebook') );
    // Use the login url on a link or button to
    // redirect to Facebook for authentication
  }
 
  /**
   * Returns the current user's info as an array.
   */
  public function get_user()
  {
    $this->get_session();
    if ( $this->session )
    {
      $request = ( new FacebookRequest( $this->session, 'GET', '/me' ) )->execute();
      $user    = $request->getGraphObject()->asArray();
 
      return $user;
    }
    return false;
  }
 
  /**
   * Get user's profile picture.
   */
  public function get_profile_pic( $user_id )
  {
    $this->get_session();
    if ( $this->session )
    {
      $request = ( new FacebookRequest( $this->session, 'GET', '/' . $user_id . '/picture?redirect=false&type=large' ) )->execute();
      $pic     = $request->getGraphObject()->asArray();
 
      if ( ! empty( $pic ) && ! $pic['is_silhouette'] ) {
        return $pic['url'];
      }
    }
    return false;
  }

    /**
     * Destroy our local Facebook session
     */
    public function destroy_session()
    {
        $this->ci->session->unset_userdata('fb_access_token');
    }
}