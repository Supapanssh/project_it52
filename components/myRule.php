<?php

namespace app\components;

use yii\filters\AccessRule;

class myRule extends AccessRule
{
    protected function matchRole($user)
    {

        if (empty($this->roles)) {
            return true;
        }

        //print_r($this->roles);
        //print "<br/>";
        foreach ($this->roles as $role) {

            /* ถ้า role เท่ากับ ? และ ผู้ใช้ยังไม่ได้ล๊อกอิน */
            $role .= '';
            if ($role == '?' && $user->getIsGuest()) {
                //print "this is guest not login";
                return true;
            } else if ($role == '@' && !$user->getIsGuest()) {
                /*
                  print "Case 2 <br/>";
                  print "Rolevar = ".$role."<br/>";
                  print "Role = >>>> ".$user->identity->role;
                  print " this is logged in";
                 */
                return true;
            } elseif (!$user->getIsGuest() && $role == $user->identity->roles) {
                /*
                  print "Last case <br/>";
                  print "Role = >>>> ".$role;
                  print "Role = ".$user->identity->role;
                 */
                return true;
            }
        }
        return false;
    }
}
