<?php
namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public function createReport($post_id, $user_id, $content)
    {

        $notification = Notification::create([
            'type' => 'report',
            'post_id' => $post_id,
            'user_id' => $user_id,
            'content' => $content,
            'status' => 'under_review',
        ]);

        return $notification;
    }

    public function createApproval($post_id, $user_id)
    {

        $notification = Notification::create(
            [
                'type' => 'approval',
                'post_id' => $post_id,
                'user_id' => $user_id,
                'content' => '',
                'status' => 'under_review',
            ]);

        return $notification;
    }
    
}
