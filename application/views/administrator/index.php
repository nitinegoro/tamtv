<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The Bootstrapper Template
 *
 * Displays all of the element template.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @since Tamtv 1.0
 */

if (isset($header))
    echo $header;

if (isset($navbar))
    echo $navbar;

if (isset($leftsidebar))
    echo $leftsidebar;

if (isset($content))
    echo $content;

if (isset($footer))
    echo $footer;

/* End of file index.php */
/* Location: ./application/views/administrator/index.php */