<?php

use Toddish\Verify\Models\User as VerifyUser;

class User extends VerifyUser {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail() {
        return $this->email;
    }

    protected function getUsername($id) {
        $user = \User::find($id);
        if ($user) {
            if (file_exists(json_decode(trim($user->avatar))->{'medium'})) {
                $photo = \URL::to(json_decode(trim($user->avatar))->{'medium'});
            } else {
                $photo = \URL::to('http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image');
            }
            if ($user->nickname) {
                $nickname = '(' . $user->nickname . ')';
            } else {
                $nickname = '';
            }
            $rs = "<span class=\"label label-success popover_avatar\" data-img-url=\"" . $photo . "\" rel=\"popover_avatar\" data-content-info-name=\"" . $user->firstname . ' ' . $user->lastname . " " . $nickname . "\" data-content-info=\"" . \User::getDepartment($user->department_id) . "\" data-placement=\"top\">" . $user->username . "</span>";
        } else {
            $rs = '';
        }
        return $rs;
    }

    protected function getFullName($id) {
        $users = \User::find($id);
        if ($users) {
            $rs = $users->firstname . ' ' . $users->lastname;
        } else {
            $rs = '';
        }
        return $rs;
    }

    protected function getAddress($id) {
        $users = \DB::table('users')
                ->join('province', 'province.PROVINCE_ID', '=', 'users.province')
                ->join('amphur', 'amphur.AMPHUR_ID', '=', 'users.amphur')
                ->join('district', 'district.DISTRICT_ID', '=', 'users.district')
                ->join('amphur_postcode', 'amphur_postcode.AMPHUR_ID', '=', 'amphur.AMPHUR_ID')
                ->select(array('users.address', 'province.PROVINCE_NAME', 'amphur.AMPHUR_NAME', 'district.DISTRICT_NAME', 'amphur_postcode.POST_CODE'))
                ->where('users.id', $id)
                ->get();
        if ($users) {
            $address = $users[0];
            return $address->address . ' ' . $address->DISTRICT_NAME . ' ' . $address->AMPHUR_NAME . ' ' . $address->PROVINCE_NAME . ' ' . $address->POST_CODE;
        } else {
            return 'No data.';
        }
    }

    protected function getAvatar($id) {
        $user = \User::find($id);
        if (file_exists(json_decode(trim($user->avatar))->{'medium'})) {
            $photo = \URL::to(json_decode(trim($user->avatar))->{'medium'});
        } else {
            $photo = \URL::to('http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image');
        }
        return $photo;
    }

    protected function getDepartment($id) {

        if ($id > 0) {
            $Department = \Categories::getRootName($id);
            return $Department;
        } else {
            return 'ยังไม่ระบุ';
        }
    }

    protected function getPosition($id) {
        $user = \User::find($id);
        $Position = \Position::find($user->position_id);
        if ($Position) {
            return $Position->name;
        } else {
            return 'ยังไม่ระบุ';
        }
    }

    protected function checkLevel($v = 500) {
        $user = new \Toddish\Verify\Models\User;
        $user->id = '' . \Auth::user()->id . '';
        return $user->level($v, '>=');
    }

    protected function getBizType($param) {
        if ($param == 1) {
            $rs = \Lang::get('user.biz_type_1');
        } elseif ($param == 2) {
            $rs = \Lang::get('user.biz_type_2');
        } elseif ($param == 3) {
            $rs = \Lang::get('user.biz_type_3');
        } else {
            $rs = '';
        }
        return $rs;
    }

}
