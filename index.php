<?php
/*
Plugin Name: WP user Sync
Description: Sets a cookie with the user's profile image and name for use on subdomains.
Version: 1.0
Author: Nishant Shah
*/

// Function to set the user profile cookie
function set_profile_cookie() {
  if (is_user_logged_in()) {
    $user = wp_get_current_user();
    $user_data = array(
      'image' => get_avatar_url($user->user_email),
      'name' => $user->display_name
    );
    setcookie('user_profile', json_encode($user_data), time() + (86400 * 30), '/', 'subdomain.example.com', false, true);
  }
}

// Function to remove the user profile cookie
function remove_profile_cookie() {
  setcookie('user_profile', '', time() - 3600, '/', 'subdomain.example.com', false, true);
}

// Register activation and deactivation hooks
register_activation_hook(__FILE__, 'set_profile_cookie');
register_deactivation_hook(__FILE__, 'remove_profile_cookie');
?>
