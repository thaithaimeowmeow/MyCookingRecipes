<?php

namespace App\Livewire\Post;

use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mary\Traits\Toast;

class ReportModal extends Component
{
    use Toast;
    public $post_id;
    public $content;
    public bool $reportModal = false;
    private $notificationService;

    public function boot(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    protected $rules = [
        'content' => 'required|string|max:255',
    ];

    public function submitReport()
    {
        $this->validate();
        $this->notificationService->createReport($this->post_id,Auth::user()->id,$this->content);
        $this->success('Report submitted!');
        $this->reset(['content']);
        $this->reportModal = false;
    }
    
    public function render()
    {
        return view('livewire.post.report-modal');
    }
}
