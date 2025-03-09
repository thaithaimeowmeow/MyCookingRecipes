<?php

namespace App\Livewire\Admin;

use App\Models\Notification;
use App\Models\Post;
use Livewire\Component;
use Mary\Traits\Toast;

class Dashboard extends Component
{

    use Toast;


    public function KeepPost($id)
    {
        $noti = Notification::findOrFail($id);
        $noti->update(['status' => 'resolved']);

        $this->success('Report resolved!');
        return redirect()->back();
    }

    public function RemovePost($id)
    {
        $noti = Notification::findOrFail($id);
        $noti->update(['status' => 'resolved']);

        $post = Post::findOrFail($noti->post->id);
        $post->delete();
        $this->success('Report resolved!');
        return redirect()->back();
    }

    public function ApprovePost($id)
    {
        $noti = Notification::findOrFail($id);
        $noti->update(['status' => 'approved']);

        $post = Post::findOrFail($noti->post->id);
        $post->update(['isApproved' => 1]);


        $this->success('Post approved');
        return redirect()->back();
    }



    public function render()
    {
        $notifications = Notification::orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.admin.dashboard', ['notifications' => $notifications])
            ->layout('components.layouts.admin');
    }

    // public function render()
    // {
    //     $notifications = Notification::orderBy('created_at', 'DESC')->get();
    //     return view('livewire.admin.dashboard',['notifications' => $notifications])->layout('components.layouts.admin');
    // }
}
