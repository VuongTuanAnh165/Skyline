<?php
return [
    'common' => [
        'success' => 'Cập nhật thành công',
        'error' => 'Cập nhật thất bại',
        'areYouSure' => 'Bạn chắc chắn không?',
        'success_register' => 'Đăng ký thành công',
        'error_register' => 'Đăng ký thất bại',
    ],

    //admin
    'admin' => [
        'table' => [
            'action' => 'Hành động',
            'create' => 'Thêm mới',
            'edit' => 'Chỉnh sửa',
            'destroy' => 'Xóa',
            'restore' => 'Khôi phục',
            'show' => 'Chi tiết',
            'stt' => 'STT',
            'timeKeeping' => 'Chấm công',
            'notCheck' => 'not check',
            'create_by' => 'Người tạo',
            'update_by' => 'Người chỉnh sửa',
            'manage' => 'Quản lý',
        ],
        'form' => [
            'save' => 'Lưu',
            'close' => 'Đóng',
        ],
        'home' => 'Trang chủ',
        'login' => [
            'fail' => 'Tài khoản hoặc mật khẩu không chính xác',
            'title' => 'Đăng nhập',
            'email' => 'Email',
            'password' => 'Password',
            'submitLogin' => 'Đăng nhập',
        ],
        'register' => [
            'title' => 'Đăng ký',
        ],
        'forgotPassword' => [
            'title' => 'Quên mật khẩu',
        ],
        'restaurant' => [
            'title' => 'Nhà hàng',
            'showTitle' => 'Thông tin nhà hàng',
            'edit' => 'Chỉnh sửa',
            'changePassword' => 'Đổi mật khẩu',
            'password_old' => 'Mật khẩu cũ',
            'password' => 'Mật khẩu mới',
            'password_confirmation' => 'Nhập lại mật khẩu mới',
            'form' => [
                'name' => 'Tên nhà hàng',
                'content' => 'Nội dung',
                'background' => 'Ảnh nền',
                'addFile' => 'Thêm ảnh nền',
                'deleteFile' => 'Xóa ảnh',
                'logo' => 'Logo',
                'phone' => 'Số điện thoại',
                'email' => 'Email'
            ],
        ],
        'branch' => [
            'title' => 'Chi nhánh',
            'showTitle' => 'Thông tin chi nhánh',
            'table' => [
                'title' => 'Bảng danh sách chi nhánh',
                'name' => 'Chi nhánh',
                'address' => 'Địa chỉ',
                'email' => 'Email',
                'phone' => 'Số điện thoại',
                'open_time' => 'Giờ mở cửa',
                'close_time' => 'Giờ đóng cửa',
            ],
            'create' => [
                'title' => 'Thêm mới chi nhánh',
            ],
            'edit' => [
                'title' => 'Chỉnh sửa chi nhánh',
            ],
            'form' => [
                'name' => 'Chi nhánh',
                'address' => 'Địa chỉ',
                'background' => 'Ảnh nền',
                'email' => 'Email',
                'phone' => 'Số điện thoại',
                'open_time' => 'Giờ mở cửa',
                'close_time' => 'Giờ đóng cửa',
                'longitude' => 'Kinh độ',
                'latitude' => 'Vĩ độ',
            ],
        ],
        'position' => [
            'title' => 'Chức vụ',
            'table' => [
                'title' => 'Bảng danh sách chức vụ',
                'name' => 'Chức vụ',
                'wage' => 'Mức lương',
                'work_type' => 'Hình thức công việc',
                'amount_personnel' => 'Số lượng nhân viên mỗi ca',
            ],
            'full' => 'Full time',
            'part' => 'Part time',
            'create' => [
                'title' => 'Thêm mới chức vụ',
            ],
            'edit' => [
                'title' => 'Chỉnh sửa chức vụ',
            ],
        ],
        'personnel' => [
            'title' => 'Nhân viên',
            'table' => [
                'title' => 'Bảng danh sách nhân viên',
                'name' => 'Họ tên',
                'email' => 'Email', 
                'phone' => 'Số điện thoại', 
                'hometown' => 'Quê quán',
                'position' => 'Chức vụ',
            ],
            'form' => [
                'givePassword' => 'Cấp mật khẩu',
                'gender' => 'Giới tính',
                'gender_boy' => 'Nam',
                'gender_girl' => 'Nữ',
                'shift' => 'Ca làm',
                'shift_morning' => 'Ca sáng',
                'shift_afternoon' => 'Ca chiều',
                'birthday' => 'Ngày sinh',
                'province' => 'Tỉnh/Thành phố',
                'district' => 'Huyện/Quận',
                'commune' => 'Xã/Phường',
                'address' => 'Địa chỉ',
                'bank' => 'Ngân hàng',
                'account_number' => 'Số tài khoản',
                'started_at' => 'Ngày bắt đầu',
                'signed_at' => 'Ngày ký hợp đồng',
                'ended_at' => 'Ngày kết thúc',
                'password' => 'Mật khẩu',
            ],
            'create' => [
                'title' => 'Thêm mới nhân viên',
            ],
            'edit' => [
                'title' => 'Chỉnh sửa nhân viên',
            ],
            'show' => [
                'title' => 'Thông tin nhân viên',
            ],
            'timekeeping' => [
                'title' => 'Chấm công nhân viên',
                'table' => [
                    'title' => 'Bảng danh sách chấm công',
                    'checkin' => 'Check in',
                    'checkout' => 'Check out',
                    'date' => 'Ngày',
                    'work_hour' => 'Số giờ công',
                ],
                'form' => [
                    'day' => 'Chọn ngày',
                    'hour' => 'Chọn giờ',
                ]
            ]
                ],
        'dish' => [
            'title' => 'Món ăn',
            'table' => [
                'title' => 'Bảng danh sách món ăn',
                'name' => 'Tên món',
                'image' => 'Hình ảnh',
                'category' => 'Loại món',
                'price' => 'Giá',
                'ingredient' => 'Menu món',
                'category_home' => 'Nhóm trang chủ'
            ],
            'type' => 'Thuộc menu món',
            'choose_type' => 'Chọn menu món',
            'create' => [
                'title' => 'Thêm mới món ăn',
            ],
            'edit' => [
                'title' => 'Chỉnh sửa món ăn',
            ],
        ],
        'category' => [
            'title' => 'Danh mục món',
            'table' => [
                'title' => 'Bảng danh sách danh mục món',
                'name' => 'Tên danh mục',
            ],
            'create' => [
                'title' => 'Thêm mới danh mục',
            ],
            'edit' => [
                'title' => 'Chỉnh sửa danh mục',
            ],
        ],
        'category_home' => [
            'title' => 'Danh mục món trang chủ',
            'table' => [
                'title' => 'Bảng danh sách danh mục món trang chủ',
            ],
            'create' => [
                'title' => 'Thêm mới danh mục món trang chủ',
            ],
            'edit' => [
                'title' => 'Chỉnh sửa danh mục món trang chủ',
            ],
        ],
        'shift' => [
            'title' => 'Thời gian làm việc',
            'form' => [
                'start' => 'Giờ bắt đầu',
                'end' => 'Giờ kết thúc',
            ],
        ],
        'post' => [
            'title' => 'Tin tức',
            'table' => [
                'title' => 'Bảng danh sách tin tức',
                'name' => 'Tên tin tức',
                'image' => 'Hình ảnh',
                'description' => 'Mô tả',
            ],
            'create' => [
                'title' => 'Thêm mới tin tức',
            ],
            'edit' => [
                'title' => 'Chỉnh sửa tin tức',
            ],
        ],
        'policy' => [
            'title' => 'Chính sách',
            'table' => [
                'title' => 'Bảng danh sách chính sách',
                'name' => 'Tên chính sách',
            ],
            'create' => [
                'title' => 'Thêm mới chính sách',
            ],
            'edit' => [
                'title' => 'Chỉnh sửa chính sách',
            ],
        ],
        'service' => [
            'title' => 'Dịch vụ',
            'table' => [
                'title' => 'Bảng danh sách dịch vụ',
                'name' => 'Tên dịch vụ',
                'image' => 'Hình ảnh',
                'service_charge' => 'Phí dịch vụ',
                'month' => 'Số tháng duy trì',
                'price' => 'Giá',
            ],
            'create' => [
                'title' => 'Thêm mới dịch vụ',
            ],
            'edit' => [
                'title' => 'Chỉnh sửa dịch vụ',
            ],
        ],
        'service_group' => [
            'title' => 'Nhóm dịch vụ',
            'table' => [
                'title' => 'Bảng danh sách nhóm dịch vụ',
                'name' => 'Tên nhóm dịch vụ',
            ],
            'create' => [
                'title' => 'Thêm mới nhóm dịch vụ',
            ],
            'edit' => [
                'title' => 'Chỉnh sửa nhóm dịch vụ',
            ],
        ],
        'service_type' => [
            'title' => 'Loại dịch vụ',
            'table' => [
                'title' => 'Bảng danh sách loại dịch vụ',
                'name' => 'Tên loại dịch vụ',
            ],
            'create' => [
                'title' => 'Thêm mới loại dịch vụ',
            ],
            'edit' => [
                'title' => 'Chỉnh sửa loại dịch vụ',
            ],
        ],
        'promotion' => [
            'title' => 'Chương trình khuyến mãi',
            'table' => [
                'title' => 'Bảng danh sách chương trình khuyến mại',
                'name' => 'Tên chương trình khuyến mại',
                'type' => 'Loại chương trình khuyến mại',
                'condition' => 'Điều kiện',
                'value' => 'Trị giá khuyến mại',
                'started_at' => 'Ngày bắt đầu',
                'ended_at' => 'Ngày kết thúc',
            ],
            'create' => [
                'title' => 'Thêm mới chương trình khuyến mại',
            ],
            'edit' => [
                'title' => 'Chỉnh sửa chương trình khuyến mại',
            ],
        ],
        'image' => [
            'title' => 'Quản lý hình ảnh',
            'table' => [
                'title' => 'Bảng danh sách hình ảnh',
                'type' => 'Loại hình ảnh',
            ],
            'type' => ['Web Admin', 'Web Customer', 'Web Restaurant', 'Web Sell', 'Web Service', 'Web User', 'App User Sell', 'App Sell'],
            'create' => [
                'title' => 'Thêm mới hình ảnh',
            ],
            'edit' => [
                'title' => 'Chỉnh sửa hình ảnh',
            ],
        ],
    ],

    //api
    'api' => [
        'common' => [
            'success' => 'Success',
            'serverError' => 'Server Error',
            'unauthenticated' => 'unauthenticated',
            'forbidden' => 'forbidden',
            'notFound' => 'Not Found',
            'new_version' => 'Phiên bản của bạn đã cũ. Vui lòng cập nhật phiên bản mới nhất để sử dụng.',
            'new_version_updating' => 'Hệ thống đang bảo trì. Vui lòng truy cập lại sau khi hệ thống bảo trì xong.',
        ],
        'request' => [
            'input_required' => "Vui lòng nhập :attribute",
            'select_required' => "Vui lòng chọn :attribute",
            'input_regex' => "Vui lòng đúng định dạng :attribute",
            'input_min' => "Vui lòng nhập độ dài :attribute ít nhất :min kí tự",
            'input_max' => "Vui lòng nhập độ dài :attribute lớn nhất :max kí tự",
            'input_min_value' => "Vui lòng nhập :attribute lớn hơn hoặc bằng :min_value",
            'input_max_value' => "Vui lòng nhập :attribute nhỏ hơn hoặc bằng :max_value",
            'input_required_with' => "Vui lòng nhập :attribute khi có :required_with",
            'input_same' => ":attribute và :same phải khớp",
            'input_date_format' => ":attribute không khớp với định dạng :date_format",
            'input_exists' => ":attribute không hơp lệ",
            'input_in' => ":attribute đã chọn không hơp lệ",
            'input_unique' => ":attribute đã tồn tại",
            'input_required_without' => " Trường :attribute là bắt buộc khi không có :value.",
            'input_password_regex' => "Mật khẩu bao gồm cả chữ và số",
            'input_username_regex' => "Vui lòng nhập Email hoạc số điện thoại",
            'input_required_if' => ":attribute là bắt buộc khi :status là :required_if",
            'input_required_unless' => ":attribute là bắt buộc khi :status là :required_unless",
            'input_integer' => ":attribute phải là số nguyên",
            'input_numeric' => ":attribute phải là số",
            'upload_image' => ':attribute phải là định dạng jpeg,png,jpg,gif,svg',
            'upload_mine' => ':attribute phải là định dạng jpeg,png,jpg,gif,svg',
            'upload_max' => 'Vui lòng chọn :attribute dưới :max',
            'input_before' => ":attribute không được lớn hơn ngày hiện tại",
            'after_or_equal' => ':attribute phải sau ngày giờ hoặc bằng :dateTime.',
        ],
        'attributes' => [
            'name' => 'họ và tên',
            'username' => 'tên tài khoản',
            'email' => 'email',
            'weight' => 'Cân nặng (kg)',
            'height' => 'Chiều cao (cm)',
            'blood_group' => 'Nhóm máu',
            'judgment' => 'Chuẩn đoán bệnh',
            'user_id' => 'Id người dùng',
            'date' => 'Ngày đăng kí khám bệnh',
            'address' => 'Địa chỉ',
            'doctor_id' => 'Tên bác sĩ',
            'test_result_url' => 'Đường dẫn ảnh',
            'test_another_url' => 'Đường dẫn file',
            'prescription_url' => 'Đường dẫn ảnh đơn thuốc',
            'user_test_id' => 'Id lịch sử xét nghiệm',
            'date_schedule' => 'Ngày khám',
            'time_schedule' => 'Giờ khám',
        ],
        'constants' => [
            'completedTrue' => 1,
            'completedFalse' => 0,
            'userInactive' => 2,
            'userActive' => 1,
            'expiredCodeUser' => 5,  //đơn vị là phút
            'expiredCodeForgot' => 10,  //đơn vị là phút
            'typeActive' => 1,
            'typeDeviceApp' => 1,
            'arrOneTwo' => [1, 2], // status male/female , active / inactive , ios/android , khám online / khám tại bv
            'typeSort' => ['ASC', 'DESC'], // type : asc / desc
            'perPage' => 10, // type : asc / desc
            'perPageHomeSpecialty' => 10,
            'genderUnknown' => 3,
            'yearOne' => 1,
            'success' => 200,
            'filePath' => 'uploads/user_test_result/',
            'filePathUser' => 'user/',
            'tempImage' => 'uploads/temp_images/',
            'keyUserConfig' => 'notification',
            'filePathResult' => 'user_test_result/',
            'filePathAnother' => 'user_test_another/',
            'filePathPrescription' => 'user_test_prescription/',
            'urlServiceIcon' => 'service/imgIcon/',
            'urlServiceImage' => 'service/imgWeb/',
            'successLogin' => 201,
            'pathAjax' => 'tmp',
            'timeRemoveFile' => 7200,     // 2 giờ , tính theo giây
            'getUserTest' => 'get-user-test',
            'getTest' => 'get-test',
            'usedLog' => 'user/used-log',
            'keyPushNotification' => env('KEY_PUSH_NOTIFICATION', 'AAAAXovgVMs:APA91bHC1IpXnTFDHiEtnrN4ivMrl9x0oT9SVhWfJjv8au1QQCPJY0evdpmXe16sJGfNy-tHIVZAotzXQ6eqgri_OYEO-NoM5gSbxlaByBipWA3pQKjtPh_IJB36MkCeQ8RcFcJE31Kt'),
            'showSocialTrue' => 1,
            'showSocialFalse' => 0,
            'deviceIdWeb' => 3,
            'loginTypeSocial' => 2,
            'lengthUserTest' => 5,
            'KeyConfigTest' => 'configTest'
        ],
        'logout' => [
            'success' => 'Đăng xuất thành công',
            'error' => 'Đăng xuất thất bại',
        ],
        'user' => [
            'register' => [
                'success' => 'Đăng ký thành công.',
                'fail' => 'Đăng ký thất bại, vui lòng kiểm tra thông tin đăng nhập',
                'viewSuccess' => 'Hiển thị thông tin thành công.',
                'viewFail' => 'Hiển thị thông tin thất bại.'
            ],
            'login' => [
                'success' => 'Đăng nhập thành công',
                'fail' => 'Đăng nhập thất bại, vui lòng kiểm tra thông tin đăng nhập'
            ],
            'chanePassword' => [
                'success' => 'Thay đổi mật khẩu thành công',
                'fail' => 'Mật khẩu cũ không đúng'
            ],
            'forgotPassword' => [
                'success' => 'Yêu cầu cấp mật khẩu thành công',
                'fail' => 'Yêu cầu cấp mật khẩu thất bại, vui lòng kiểm tra thông tin đã gửi'
            ],
            'verifyForgotPassword' => [
                'success' => 'Cấp mật khẩu thành công',
                'fail' => 'Cấp mật khẩu thất bại, vui lòng kiểm tra thông tin đã gửi',
                'confirm' => 'Xác thực thành công.',
                'expire' => 'Mã code hết hạn, yêu cầu cấp lại mã code',
            ],
            'verifyRegister' => [
                'success' => 'Xác thực tài khoản thành công',
                'fail' => 'Xác thực tài khoản thất bại, vui lòng kiểm tra thông tin đã gửi',
                'expire' => 'Mã code hết hạn, yêu cầu cấp lại mã code',
            ],
            'listService' => [
                'success' => 'Hiển thị danh sách dịch vụ thành công',
                'fail' => 'Hiển thị danh sách dịch vụ thất bại, vui lòng kiểm tra thông tin đã gửi',
            ],
            'storeUserFile' => [
                'success' => 'Tạo hồ sơ bệnh án thành công',
                'fail' => 'Tạo hồ sơ bệnh án thất bại, vui lòng kiểm tra thông tin đã gửi',
            ],
            'storeMedicalHistory' => [
                'success' => 'Tạo lịch sử khám bệnh thành công',
                'fail' => 'Tạo lịch sử khám bệnh thất bại, vui lòng kiểm tra thông tin đã gửi',
            ],
            'listMedicalHistory' => [
                'success' => 'Hiển thị danh sách lịch sử khám bệnh thành công',
                'fail' => 'Hiển thị danh sách lịch sử khám bệnh thất bại',
            ],
            'detailMedicalHistory' => [
                'success' => 'Hiển thị chi tiết lịch sử khám bệnh thành công',
                'fail' => 'Hiển thị chi tiết lịch sử khám bệnh thất bại',
            ],
            'updateMedicalHistory' => [
                'success' => 'Cập nhật lịch sử khám bệnh thành công',
                'fail' => 'Cập nhật lịch sử khám bệnh thất bại',
            ],
            'RegisterConsult' => [
                'success' => 'Đăng kí tư vấn thành công',
            ],
            'doctorByService' => [
                'success' => 'Lấy danh sách bác sĩ theo dịch vụ thành công',
            ],
            'doctorBySpecialty' => [
                'success' => 'Lấy danh sách bác sĩ theo chuyên khoa thành công',
            ],
            'createScheduleUserFile' => [
                'success' => 'Đăng kí lịch khám bệnh thành công',
                'fail' => 'Đăng kí lịch khám bệnh thất bại',
            ],
            'dateByDoctor' => [
                'success' => 'Lấy danh sách ngày khám theo bác sĩ thành công',
            ],
            'timeByDate' => [
                'success' => 'Lấy danh sách giỜ khám theo theo ngày của bác sĩ thành công',
            ],
            'listTest' => [
                'success' => 'Lấy danh sách chỉ số theo kết loại xét nghiệm thành công',
            ],
            'listUserConfig' => [
                'success' => 'Hiển thị cài đặt ứng dụng thành công',
                'fail' => 'Hiển thị cài đặt ứng dụng thất bại',
            ],
            'userConfig' => [
                'success' => 'Cài đặt ứng dụng thành công',
                'fail' => 'Cài đặt ứng dụng thất bại',
            ],
            'update' => [
                'success' => 'Cập nhật thành công',
                'fail' => 'Cập nhật thất bại, vui lòng kiểm tra thông tin chỉnh sửa'
            ],
            'usedLog' => [
                'success' => 'Hiển thị danh sách lịch sử hoạt động thành công',
                'fail' => 'Hiển thị danh sách lịch sử hoạt động thất bại',
            ],
            'userFileShow' => [
                'success' => 'Hiển thị hồ sơ người dùng thành công',
                'fail' => 'Hiển thị hồ sơ người dùng thất bại',
            ],
            'updateUserFile' => [
                'success' => 'Chỉnh sửa hồ sơ bệnh án thành công',
                'fail' => 'Chỉnh sửa hồ sơ bệnh án thất bại, vui lòng kiểm tra thông tin đã gửi',
            ],
            'getDoctor' => [
                'success' => 'lấy danh sách bác sĩ thành công.',
            ]
        ],
        'doctor' => [
            'listUser' => [
                'success' => 'Lấy danh sách bệnh nhân thành công',
                'fail' => ' Lấy danh sách bệnh nhân thất bại'
            ],
            'getUser' => [
                'success' => ' Lấy thông tin bệnh nhân thành công',
                'fail' => ' Lấy thông tin bệnh nhân thất bại'
            ],
            'getUserMedicalHistory' => [
                'success' => ' Lấy danh sách lịch sử khám bệnh của bệnh nhân thành công',
                'fail' => ' Lấy danh sách lịch sử khám bệnh của bệnh nhân thất bại'
            ],
            'listScheduleWork' => [
                'success' => ' Lấy danh sách lịch khám của bác sĩ thành công',
            ]
        ],
        'news' => [
            'listNews' => [
                'success' => 'Lấy danh sách tin tức thành công',
                'fail' => 'Lấy danh sách tin tức thất bại'
            ]
        ],
        'listUserConfigTest' => [
            'success' => 'Hiển thị chỉ số xét nghiệm thành công',
            'fail' => 'Hiển thị chỉ số xét nghiệm thất bại',
        ],
        'userConfigTest' => [
            'success' => 'Cài đặt chỉ số xét nghiệm thành công',
            'fail' => 'Cài đặt chỉ số xét nghiệm thất bại',
        ],
    ],
];
