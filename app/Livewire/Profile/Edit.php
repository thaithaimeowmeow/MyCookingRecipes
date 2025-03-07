<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;

class Edit extends Component
{
    use Toast;
    use WithFileUploads;
    public $username;
    public $email;
    public User $user;
    public $image;
    public $avatar;

    public $password;
    public $password_confirmation;



    protected function rules()
    {
        return [
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore(Auth::id())],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore(Auth::id()),
            ],
        ];
    }

    public function editInfo()
    {
        $this->validate();
        if ($this->image) {
            $this->validate([
                'image' => 'image',
            ]);
        }
        else{
            return;
        }
        
        // $cloudinaryUploadUrl = cloudinary()->upload($this->image->getRealPath())->getSecurePath();
        $cloudinaryUploadUrl = cloudinary()->upload($this->image->getRealPath(), [
            'folder' => 'avatar',
            'transformation' => [
                'width' => 500,
                'height' => 500,
                'crop' => 'fill'
            ]
        ])->getSecurePath();

        $this->user->avatar = $cloudinaryUploadUrl;
        $this->user->username = $this->username;
        $this->user->email = $this->email;
        $this->user->save();
        $this->success('Information saved!');
        return $this->redirect(route('user.edit',$this->username));
    }

    public function changePassword()
    {
    $this->validate([
        'password' => [
            'required',
            'confirmed',
            Password::min(8)
                ->letters() // At least one letter
                ->mixedCase() // At least one uppercase & one lowercase
                ->numbers() // At least one number
                ->symbols() // At least one special character
        ],
    ]);

    $this->user->update([
        'password' => Hash::make($this->password),
    ]);

    $this->success('Password changed successfully!');
    return $this->redirect(route('user.edit',$this->username));
    
    }


    public function mount()
    {
        if (Auth::user()->username !== $this->username) {
            return redirect()->route('home');
        }
        $this->user = User::where('username', $this->username)->firstOrFail();
        $this->email = $this->user->email;
        $this->avatar = $this->user->avatar;
    }


    public function render()
    {
        return view('livewire.profile.edit');
    }
}
