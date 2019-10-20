<?php

namespace App\Constants;

/**
 * Class HttpResponse
 *
 * @package App\Constants
 */
class UserSetting
{
    /**
     * @var integer Gender
     */
    const MAN = 1;
    const FEMALE = 2;

    /**
     * @var integer status
     */
    const DISABLE = 0;
    const ENABLE = 1;
    const EXPIRED = 2;

    //Quyền người dùng
    const ADMIN_ROLE = 1; // Vai trò admin
    const PSYCHOLOGY_ROLE = 2; // Tư vấn viên tâm lý
    const JURISTIC_ROLE = 3; // Tư vấn viên pháp lý
}
