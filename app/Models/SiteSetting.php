<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SiteSetting extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'site_settings';

    protected $guarded = [];

    public $timestamps = true;

    // id of attribute in site_setting table
    const MORNING_START_ID = 1;
    const MORNING_END_ID = 2;
    const AFTERNOON_START_ID = 3;
    const AFTERNOON_END_ID = 4;
    const DAY_OFF_ID = 5;
    const MIN_TIME_PROJECT_ID = 6;
    const MEETING_ID = 7;
    const DISPLAY_TASK_PROJECT_ID = 8;
    const GANTT_TASK_COLOR_MODE = 9;
    const DISPLAY_COLUMN_TASK = 10;
    const CREATE_EVALUATION_WEEK_ID = 11;

    const SUNDAY = 1;
    const MONDAY = 2;
    const TUESDAY = 3;
    const WEDNESDAY = 4;
    const THURSDAY = 5;
    const FRIDAY = 6;
    const SATURDAY = 7;

    const MEETING_PRIVATE = 0;
    const MEETING_PUBLIC = 1;

    const HIDE_TASK_PROJECT_ID = 0;
    const SHOW_TASK_PROJECT_ID = 1;
    const GANTT_TASK_COLOR_BY_PROGRESS = 0;
    const GANTT_TASK_COLOR_BY_LEVEL = 1;
    const NOT_CREATE_EVALUATION_WEEK = 0;
    const CREATE_EVALUATION_WEEK = 1;

    /**
     * Save id user created or updated
     */
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($data) {
            $data->created_by = auth()->id();
        });
        self::saving (function ($data) {
            $data->updated_by = auth()->id();
        });
    }


    /**
     * Get morning start time.
     *
     * @return string
     */
    public static function morningStart(){
        $result = self::find(self::MORNING_START_ID);
        if ($result){
            $result = $result->value;
        } else {
            $result = '07:00:00';
        }
        return($result);
    }

    /**
     * Get morning end time.
     *
     * @return string
     */
    public static function morningEnd(){
        $result = self::find(self::MORNING_END_ID);
        if ($result){
            $result = $result->value;
        } else {
            $result = '15:00:00';
        }
        return($result);
    }

    /**
     * Get afternoon start time.
     *
     * @return string
     */
    public static function afternoonStart(){
        $result = self::find(self::AFTERNOON_START_ID);
        if ($result){
            $result = $result->value;
        } else {
            $result = '15:00:00';
        }
        return($result);
    }

    /**
     * Get afternoon end time.
     *
     * @return string
     */
    public static function afternoonEnd(){
        $result = self::find(self::AFTERNOON_END_ID);
        if ($result){
            $result = $result->value;
        } else {
            $result = '23:00:00';
        }
        return($result);
    }

    /**
     * Check working in Saturday
     *
     * @return bool
     */
    public static function workingSATURDAY(){
        $result = self::find(self::DAY_OFF_ID);
        if ($result){
            $dayoff =  json_decode(self::find(self::DAY_OFF_ID)->value, true);
            if (!is_array($dayoff)){
                $dayoff = [];
            }
            $result = !in_array(self::SATURDAY, $dayoff);
        } else {
            $result = false;
        }

        return $result;
    }

    /**
     * Check working in Sunday
     *
     * @return bool
     */
    public static function workingSUNDAY(){
        $result = self::find(self::DAY_OFF_ID);
        if ($result){
            $dayoff =  json_decode(self::find(self::DAY_OFF_ID)->value, true);
            if (!is_array($dayoff)){
                $dayoff = [];
            }
            $result = !in_array(self::SUNDAY, $dayoff);
        } else {
            $result = false;
        }

        return $result;
    }
}
