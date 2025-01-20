<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Artisan;
use App\Services\SettingsService;
use Livewire\Attributes\Rule;

class AdminSettingsPanel extends Component
{
    #[Url()]
    public $tab;

    #[Rule('sometimes|min:2|max:250')]
    public $instagramApiKey;

    #[Rule('sometimes|min:2|max:50')]
    public $instagramUserId;

    public $tabs = [
        'cache' => 'Cache',
        'integrations' => 'Integrações',
    ];

    public function mount()
    {
        $this->tab = array_key_first($this->tabs);
        $this->instagramApiKey = (new SettingsService)->setting('instagram_api_key');
        $this->instagramUserId = (new SettingsService)->setting('instagram_user_id');
    }

    public function setTab($tab)
    {
        $this->tab = $tab;
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


    public function render()
    {
        return view('livewire.admin-settings-panel', [
            'tabs' => $this->tabs,
        ]);
    }
}
