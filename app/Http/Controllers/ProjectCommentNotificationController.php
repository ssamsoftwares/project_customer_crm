<?php

namespace App\Http\Controllers;

use App\Models\ProjectCommentNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProjectCommentNotificationController extends Controller
{

    public function markAsReadNotification(ProjectCommentNotification $notification){

        DB::beginTransaction();

        try{
            $notification->update(['status'=>'seen']);

            // $notification->delete();
        }catch(Exception $e){
            DB::rollBack();
            return Redirect::back()->with('status',$e->getMessage());
        }
        DB::commit();
        return Redirect::back()->with('status','This comment Mark as read');

    }


}
