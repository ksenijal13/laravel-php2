<?php


namespace App\Models;


class Activity
{
    const ACTIVITY_LIMIT = 10;
    public function getAllActivities($offset){
        $offset = ((int) $offset) * self::ACTIVITY_LIMIT;
        return \DB::table("activity as a")
            ->join("users as u", "u.user_id", "=", "a.user_id")
            ->select("*", "a.user_id as userId")
            ->limit(self::ACTIVITY_LIMIT)
            ->offset($offset)
            ->get();
    }
    public function countActivities(){
        return \DB::table("activity")
            ->select(\DB::raw('COUNT(*) as number'))
            ->first();
    }
    public function sortActivities($offset, $sort){
        $offset = ((int) $offset) * self::ACTIVITY_LIMIT;
        return \DB::table("activity as a")
            ->join("users as u", "u.user_id", "=", "a.user_id")
            ->select("*", "a.user_id as userId")
            ->orderBy("date", $sort)
            ->limit(self::ACTIVITY_LIMIT)
            ->offset($offset)
            ->get();
    }
    public function storeActivity($userId, $ipAddress, $activity){
        \DB::table("activity")
            ->insert([
               "user_id" => $userId,
               "ip_address" => $ipAddress,
               "activity" => $activity,
                "new" => 1
            ]);
    }
    public function updateActivity(){
        \DB::table("activity")
            ->update([
                "new" => 0
            ]);
    }
    public function countNewActivities(){
        return \DB::table("activity")
            ->select(\DB::raw('COUNT(*) as number'))
            ->where("new", 1)
            ->first();
    }
    public function writeActivityInFile($activity){
        $logPath = realpath('../storage/logs/activity.txt');
        $file = fopen($logPath, 'a');
        fwrite($file, $activity);
        fclose($file);
    }
}
