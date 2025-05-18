<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Artisan;
use App\Services\SettingsService;
use Livewire\Attributes\Rule;
use App\Models\User;
use Illuminate\Support\Facades\File;

class AdminSettingsPanel extends Component
{
    #[Url(as: 'tab')]
    public $tab = 'cache';

    public $users;

    #[Rule('sometimes|min:2|max:250')]
    public $instagramApiKey;

    #[Rule('sometimes|min:2|max:50')]
    public $instagramUserId;

    public $tempFilesCount;

    public $tabs = [
        'cache' => 'Cache',
        'integrations' => 'Integrações',
        'users' => 'Usuários'
    ];


    public function loadUsers()
    {
        $this->users = ($this->tab == 'users') ? User::all() : collect();
        //$this->users = User::all();
    }

    public function updatedTab()
    {
        $this->loadUsers();
    }

    public function mount()
    {
        $this->tab = array_key_first($this->tabs);
        $this->instagramApiKey = (new SettingsService)->setting('instagram_api_key');
        $this->instagramUserId = (new SettingsService)->setting('instagram_user_id');
        $this->loadUsers();
    }

    public function setTab($tab)
    {
        $this->tab = $tab;
        $this->loadUsers();
    }

    // Aba cache
    public function clearCache($cache){
        switch ($cache){
            case "general":
                Artisan::call('cache:clear');
                session()->flash('success', 'Cache geral limpo com sucesso.');
                break;

            case "view":
                Artisan::call('view:clear');
                session()->flash('success', 'Cache de views limpo com sucesso.');
                break;

            case "route":
                Artisan::call('route:clear');
                session()->flash('success', 'Cache de rotas limpo com sucesso.');
                break;

            case "config":
                Artisan::call('config:clear');
                session()->flash('success', 'Cache de configuração limpo com sucesso.');
                break;
        }
    }

    // Aba integrações
    public function updatingInstagramApiKey($value){
        $this->instagramApiKey = $value;

        $this->validate();

        (new SettingsService)->setting('instagram_api_key', $this->instagramApiKey);
    }

    public function updatingInstagramUserId($value){
        $this->instagramUserId = $value;

        $this->validate();

        (new SettingsService)->setting('instagram_user_id', $this->instagramUserId);
    }

    public function deleteUser($id){
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->back()->with('success', 'Usuário deletado com sucesso.');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function clearTempFolder(){
        $tempPath = public_path('storage/temp');
        $files = File::files($tempPath);
        foreach ($files as $file) {
            File::delete($file->getPathname());
        }
        session()->flash('success', 'Pasta temporária limpa com sucesso.');
    }

    public function render()
    {
        $this->tempFilesCount = count(File::files(public_path('storage/temp')));

        return view('livewire.admin-settings-panel', [
            'tabs' => $this->tabs,
        ]);
    }
}
