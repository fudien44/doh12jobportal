<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $connection = 'mysql';
    protected $table = 'profiles';
    protected $guarded = array();

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
                return ' ';
                break;
        }
    }
    public function pwd() {
        switch ($this->is_pwd) {
            case '1':
                return 'No';
                break;
            case '0':
                return 'Yes';
                break;
            default:
                return 'N/A';
                break;
        }
    }
    public function solpar() {
        switch ($this->is_solpar) {
            case '1':
                return 'No';
                break;
            case '0':
                return 'Yes';
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
                 return '';
                 break;
        }
    }
    public function sx() {
        switch ($this->sex) {
            case '0':
                return 'Male';
                break;
            case '1':
                return 'Female';
                break;
            default:
                return 'N/A';
                break;
        }
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
                return ' ';
                break;
        }
    }
}
