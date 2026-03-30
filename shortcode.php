<?php
function sm_student_list_shortcode() {
    $args = array(
        'post_type'      => 'student',
        'posts_per_page' => -1,
        'status'         => 'publish'
    );

    $query = new WP_Query($args);
    
    if (!$query->have_posts()) return 'Không có sinh viên nào.';

    $output = '<table class="sm-student-table" border="1" style="width:100%; border-collapse: collapse; margin-top: 20px;">';
    $output .= '<thead><tr><th>STT</th><th>MSSV</th><th>Họ tên</th><th>Lớp</th><th>Ngày sinh</th></tr></thead><tbody>';

    $stt = 1;
    while ($query->have_posts()) {
        $query->the_post();
        $id = get_the_ID();
        $mssv = get_post_meta($id, '_sm_mssv', true);
        $major = get_post_meta($id, '_sm_major', true);
        $dob = get_post_meta($id, '_sm_dob', true);

        $output .= "<tr>
            <td style='text-align:center;'>{$stt}</td>
            <td>" . esc_html($mssv) . "</td>
            <td>" . get_the_title() . "</td>
            <td>" . esc_html($major) . "</td>
            <td>" . esc_html($dob) . "</td>
        </tr>";
        $stt++;
    }
    
    $output .= '</tbody></table>';
    wp_reset_postdata();

    return $output;
}
add_shortcode('danh_sach_sinh_vien', 'sm_student_list_shortcode');