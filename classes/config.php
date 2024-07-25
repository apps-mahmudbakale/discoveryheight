<?php
/**
 * config.php
 *
 * Author: Mahmud Bakale
 *
 * Configuration file. It contains variables used in the template as well as the primary navigation array from which the navigation is created
 *
 */

/* Template variables */
$template = array(
    'name'              => 'Discovery Height School Management System',
    'version'           => '1.9',
    'company'           => 'Bnetworks Tech Solutions',
    'author'            => 'Mahmud Bakale,',
    'robots'            => 'noindex, nofollow',
    'title'             => 'Discovery Height School',
    'sidebar_title'     => 'Discovery Height',
    'description'       => 'Discovery Height School Management System is a Web App  created by Mahmud Bakale',
    // true                         enable page preloader
    // false                        disable page preloader
    // The following variable is used for setting the active link in the sidebar menu
    'active_page'       => basename($_SERVER['PHP_SELF'])
);


session_status() === PHP_SESSION_ACTIVE ?: session_start();



if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['section'])) {

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        // last request was more than 30 minutes ago
            unset($_SESSION['user_id']);     // unset $_SESSION variable for the run-time 
            unset($_SESSION['section']);     // unset $_SESSION variable for the run-time 
            unset($_SESSION['username']);     // unset $_SESSION variable for the run-time 
            echo "<script>window.location='forbidden.php'</script>";
   
        }
       
}else{
// echo "<script>window.location='forbidden.php'</script>";

}
 $_SESSION['LAST_ACTIVITY'] = time();

/* Primary navigation array (the primary navigation will be created automatically based on this array, up to 3 levels deep) */

