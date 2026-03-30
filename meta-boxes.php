<?php
// Thêm Meta Box vào trang chỉnh sửa Sinh viên
function sm_add_student_meta_boxes() {
    add_meta_box('sm_details', 'Thông tin chi tiết', 'sm_render_meta_box', 'student', 'normal', 'high');
}
add_action('add_meta_boxes', 'sm_add_student_meta_boxes');

function sm_render_meta_box($post) {
    // Tạo Nonce để xác thực bảo mật
    wp_nonce_field('sm_save_meta_box_data', 'sm_meta_box_nonce');

    // Lấy dữ liệu cũ nếu có
    $mssv = get_post_meta($post->ID, '_sm_mssv', true);
    $major = get_post_meta($post->ID, '_sm_major', true);
    $dob = get_post_meta($post->ID, '_sm_dob', true);
    ?>
    <p>
        <label>MSSV:</label>
        <input type="text" name="sm_mssv" value="<?php echo esc_attr($mssv); ?>" class="widefat">
    </p>
    <p>
        <label>Chuyên ngành:</label>
        <select name="sm_major" class="widefat">
            <option value="CNTT" <?php selected($major, 'CNTT'); ?>>CNTT</option>
            <option value="Kinh tế" <?php selected($major, 'Kinh tế'); ?>>Kinh tế</option>
            <option value="Marketing" <?php selected($major, 'Marketing'); ?>>Marketing</option>
        </select>
    </p>
    <p>
        <label>Ngày sinh:</label>
        <input type="date" name="sm_dob" value="<?php echo esc_attr($dob); ?>" class="widefat">
    </p>
    <?php
}

// Lưu dữ liệu khi nhấn "Cập nhật" hoặc "Đăng"
function sm_save_student_meta($post_id) {
    if (!isset($_POST['sm_meta_box_nonce']) || !wp_verify_nonce($_POST['sm_meta_box_nonce'], 'sm_save_meta_box_data')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['sm_mssv'])) update_post_meta($post_id, '_sm_mssv', sanitize_text_field($_POST['sm_mssv']));
    if (isset($_POST['sm_major'])) update_post_meta($post_id, '_sm_major', sanitize_text_field($_POST['sm_major']));
    if (isset($_POST['sm_dob'])) update_post_meta($post_id, '_sm_dob', sanitize_text_field($_POST['sm_dob']));
}
add_action('save_post', 'sm_save_student_meta');