<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    protected $connection = 'mysql';
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'contactno', 
        'email', 
        'password',
        'level',
        'void',
        'user_id',
        'extension',
        'dob',
        'sex',
        'gender',
        'age',
        'religion',
        'civilstat',
        'ethnicity',
        'address',
        'course',
        'school',
        'contactnum',
        'email',
        'highest_education',
        'pwd',
        'soloparent',
        'eligibility',
        'work_experience',
        'training',
        'pds_file',
        'tor_file',
        'eligibility_file',
        'other_document_file',
        'picture_link',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function myjobs() {
        return $this->hasMany(Application::class, 'user_id', 'id')->orderBy('id','desc');
    }
    public function profile() {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }
    public function pds() {
        return $this->hasMany(PdsFile::class, 'user_id', 'id');
    }
    public function tor() {
        return $this->hasMany(TorFile::class, 'user_id', 'id');
    }
    public function wes() {
        return $this->hasMany(Wes::class, 'user_id', 'id');
    }
    public function tc() {
        return $this->hasMany(Tc::class, 'user_id', 'id');
    }
    public function coe() {
        return $this->hasMany(Coe::class, 'user_id', 'id');
    }
    public function ipcr() {
        return $this->hasMany(Ipcr::class, 'user_id', 'id');
    }
    public function elig() {
        return $this->hasMany(EligFile::class, 'user_id', 'id');
    }
    public function odoc() {
        return $this->hasMany(OtherFile::class, 'user_id', 'id');
    }
    public function cs() {
        switch ($this->civilstat) {
            case '0':
                return 'Single';
                break;
            case '1':
                return 'Married';
                break;
            case '2':
                return 'Separated';
                break;
            case '3':
                return 'Widowed';
                break;
            case '4':
                return 'Other';
                break;
            default:
                return 'N/A';
                break;
        }
    }
    public function gndr() {
        switch ($this->gender) {
            case '0':
                return 'Male';
                break;
            case '1':
                return 'Female';
                break;
            case '2':
                return 'Transgender';
                break;
            case '3':
                return 'Two-Spirit';
                break;
            case '4':
                return 'Cisgender';
                break;
            case '5':
                return 'Non-binary';
                break;
            case '6':
                return 'Genderqueer';
                break;
            case '7':
                return 'Gender expression';
                break;
            case '8':
                return 'Gender fluid';
                break;
            case '9':
                return 'Gender neutral';
                break;
            case '10':
                return 'Prefer Not to Say';
                break;
            default:
                return 'N/A';
                break;
        }
    }
    public function relgion() {
        switch ($this->religion) {
            case 'AGLIP':
            return 'AGLIPAY';
            break;
            case 'ALLY' :
            return 'ALLIANCE OF BIBLE CHRISTIAN COMMUNITIES';
            case 'ANGLI' :
            return 'ANGLICAN';
            break;
            case 'BAPTI' :
            return 'AGLIPAY';
            break;
            case 'BRNAG' :
            return 'BORN AGAIN CHRISTIAN';
            break;
            case 'BUDDH' :
            return 'BUDDHISM';
            break;
            case 'CATHO' :
            return 'CATHOLIC';
            break;
            case 'XTIAN' :
            return 'CHRISTIAN';
            break;
            case 'CHOG' :
            return 'CHURCH OF GOD';
            break;
            case 'EVANG' :
            return 'EVANGELICAL';
            break;
            case 'IGNIK' :
            return 'IGLESIA NI CRISTO';
            break;
            case 'MUSLI' :
            return 'ISLAM';
            break;
            case 'JEWIT' :
            return 'JEHOVAHS WITNESS';
            break;
            case 'MORMO' :
            return 'LDS-MORMONS';
            break;
            case 'LRCM' :
            return 'LIFE RENEWAL CHRISTIAN MINISTRY';
            break;
            case 'LUTHR' :
            return 'LUTHERAN';
            break;
            case 'METOD' :
            return 'METHODIST';
            break;
            case 'PENTE' :
            return 'PENTECOSTAL';
            break;
            case 'PROTE' :
            return 'PROTESTANT';
            break;
            case 'SVDAY' :
            return 'SEVENTH DAY ADVENTIST';
            break;
            case 'UCCP' :
            return 'UCCP';
            break;
            case 'UNKNO' :
            return 'UNKNOWN';
            break;
            case 'WESLY' :
            return 'WESLEYAN';
            default:
                return 'UNKNOWN';
                break;
        }
    }
}
