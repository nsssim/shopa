<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['pre_controller'][] = array(
                                'class'    => 'Carta_hook',
                                'function' => 'restore_customer_cart',
                                'filename' => 'Carta_hook.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );

$hook['pre_controller'][] = array(
                                'class'    => 'Carta_hook',
                                'function' => 'restore_guest_cart',
                                'filename' => 'Carta_hook.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );


/* End of file hooks.php */
/* Location: ./application/config/hooks.php */