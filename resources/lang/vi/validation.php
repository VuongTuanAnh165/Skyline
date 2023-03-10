<?php
return [
    'form' => [
        'input_required' => "Vui lòng nhập :attribute",
        'select_required' => "Vui lòng chọn :attribute",
        'input_regex' => "Vui lòng nhập đúng định dạng :attribute bao gồm: chữ thường, chữ hoa, số",
        'ip_regex' => "Vui lòng nhập đúng định dạng :attribute",
        'input_min' => "Vui lòng nhập độ dài :attribute ít nhất :min kí tự",
        'input_max' => "Vui lòng nhập độ dài :attribute lớn nhất :max kí tự",
        'input_min_value' => "Vui lòng nhập :attribute lớn hơn hoặc bằng :min_value",
        'input_max_value' => "Vui lòng nhập :attribute nhỏ hơn hoặc bằng :max_value",
        'input_unique' => ":attribute đã được sử dụng",
        'input_invalid' => ":attribute vừa nhập không hợp lệ",
        'image' => 'Vui lòng tải file có đuôi .jpeg, .png, .jpg, .gif, .svg',
        'file_size' => 'Vui lòng tải file có dung lượng không quá :max_value',
        'input_required_if' => ":attribute là bắt buộc khi :status là :required_if",
        'input_in' => ":attribute đã chọn không hơp lệ",
        'input_exists' => ":attribute không hơp lệ",
        'input_date_format' => ":attribute không khớp với định dạng :date_format",
        'input_before' => ":attribute không được lớn hơn ngày hiện tại",
        'input_before_personnel' => ":attribute phải lớn hơn 18 tuổi",
        'after_or_equal_arr' => ":attribute phải lớn hơn hoặc bằng ngày bắt đầu : :date",
        'input_integer' => ":attribute phải là số nguyên",
        'input_numeric' => ":attribute phải là số thực",
        'input_required_icon' => "Vui lòng chọn :attribute",
        'input_before_user' => ":attribute phải nhỏ hơn hoặc bằng ngày hiện tại",
        'upload_image' => ':attribute phải là định dạng jpeg,png,jpg,gif,svg',
        'upload_mine' => ':attribute phải là định dạng jpeg,png,jpg,gif,svg',
        'upload_max' => 'Vui lòng chọn :attribute dưới :max',
        'end_before' => ':attribute phải nhỏ hơn :date',
    ],
    'attributes' => [
        'first_name' => 'họ',
        'last_name' => 'tên',
        'name' => 'họ và tên',
        'email' => 'email',
        'icon' => 'icon',
    ],
    'open_close' => 'Thời gian sau phải lớn hơn thời gian trước',
    'restaurant_login' => 'Tài khoản hoặc mật khẩu không chính xác',
    'password_old_new' => "Mật khẩu mới giống mật khẩu cũ",
    'start_end' => 'Thời gian vi phạm ca trước',
    'end_start' => 'Thời gian vi phạm ca sau',
    'personnel_position' => 'Chức vụ đã đủ nhân viên',
];
