<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfileInformationForm extends Component
{
    use WithFileUploads;

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * The new avatar for the user.
     *
     * @var mixed
     */
    public $photo;

    /**
     * Determine if the verification email was sent.
     *
     * @var bool
     */
    public $verificationLinkSent = false;

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $user = Auth::user();

        $this->state = array_merge([
            'email' => $user->email,
        ], $user->withoutRelations()->toArray());
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        $input = $this->photo
            ? array_merge($this->state, ['photo' => $this->photo])
            : $this->state;

        \Log::debug('UpdateProfileInformation Input:', $input);
        \Log::debug('Photo property:', ['photo' => $this->photo, 'photo_type' => gettype($this->photo)]);

        $updater->update(Auth::user(), $input);

        // Refrescar el usuario desde la base de datos
        Auth::user()->refresh();

        // Actualizar el estado local con los datos más recientes
        $user = Auth::user();
        $this->state = array_merge([
            'email' => $user->email,
        ], $user->withoutRelations()->toArray());

        if (isset($this->photo)) {
            $this->photo = null;
            $this->dispatch('saved');
            $this->dispatch('refresh-navigation-menu');
        } else {
            $this->dispatch('saved');
            $this->dispatch('refresh-navigation-menu');
        }
    }

    /**
     * Delete user's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {
        Auth::user()->deleteProfilePhoto();

        // Refrescar el usuario desde la base de datos
        Auth::user()->refresh();

        $this->dispatch('refresh-navigation-menu');
    }

    /**
     * Sent the email verification.
     *
     * @return void
     */
    public function sendEmailVerification()
    {
        Auth::user()->sendEmailVerificationNotification();

        $this->verificationLinkSent = true;
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('profile.update-profile-information-form', [
            'user' => Auth::user(),
        ]);
    }
}
