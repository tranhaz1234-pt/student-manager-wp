<?php
/**
 * Plugin Name: Student Manager
 * Description: Quản lý thông tin sinh viên với Custom Post Type và Meta Boxes.
 * Version: 1.0
 * Author: Your Name
 */

if (!defined('ABSPATH')) exit;

// Định nghĩa đường dẫn hằng số
define('SM_PATH', plugin_dir_path(__FILE__));

// Nạp các file xử lý logic
require_once SM_PATH . 'includes/cpt-student.php';
require_once SM_PATH . 'includes/meta-boxes.php';
require_once SM_PATH . 'includes/shortcode.php';

// Kích hoạt CSS cho Frontend (Tùy chọn)
add_action('wp_enqueue_scripts', 'sm_enqueue_styles');
function sm_enqueue_styles() {
    wp_enqueue_style('sm-style', plugins_url('assets/style.css', __FILE__));
}