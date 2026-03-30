<?php
function sm_register_student_post_type() {
    $labels = array(
        'name'               => 'Sinh viên',
        'singular_name'      => 'Sinh viên',
        'menu_name'          => 'Sinh viên',
        'add_new'            => 'Thêm sinh viên mới',
        'add_new_item'       => 'Thêm sinh viên',
        'edit_item'          => 'Sửa thông tin sinh viên',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-businessman',
        'supports'           => array('title', 'editor'),
        'rewrite'            => array('slug' => 'sinh-vien'),
    );

    register_post_type('student', $args);
}
add_action('init', 'sm_register_student_post_type');