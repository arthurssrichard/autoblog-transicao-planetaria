<div class="space-y-5">
    <!-- Abas -->
    <div class="border-b border-gray-200 dark:border-gray-600">
        <nav class="flex space-x-4" aria-label="Tabs" role="tablist">
            @foreach($tabs as $key => $label)
            <button
                type="button"
                wire:click="setTab('{{ $key }}')"
                class="relative py-2 px-6 text-sm font-medium transition duration-300 rounded-t-md
                {{ $tab === $key ? 'text-neutral-800 dark:text-neutral-200 shadow-sm border-b-2  border-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
                {{ $label }}
            </button>
            @endforeach
        </nav>
    </div>

    @if(session()->has('success'))
    <x-alerts.success-alert title="Sucesso" message="{{ session('success') }}" />
    @endif

    <!-- Conteúdo das abas -->
    <div class="mt-3">

        <div role="tabpanel" class="{{$tab === 'cache' ? '' : 'hidden'}}">
            <h2 class="text-2xl font-bold dark:text-neutral-300">Cache do sistema</h2>

            <div class="flex flex-col w-max">
                <div class="mt-3 flex items-center gap-4 p-2 justify-between">
                    <h3 class="text-xl font-semibold text-neutral-700 dark:text-neutral-400">Cache geral</h3>
                    <button class="btn-small-blue" wire:click="clearCache('general')">Limpar</button>
                </div>
                <div class="mt-3 flex items-center gap-4 p-2 justify-between">
                    <h3 class="text-xl font-semibold text-neutral-700 dark:text-neutral-400">Cache view</h3>
                    <button class="btn-small-blue" wire:click="clearCache('view')">Limpar</button>
                </div>
                <div class="mt-3 flex items-center gap-4 p-2 justify-between">
                    <h3 class="text-xl font-semibold text-neutral-700 dark:text-neutral-400">Cache rotas</h3>
                    <button class="btn-small-blue" wire:click="clearCache('route')">Limpar</button>
                </div>
                <div class="mt-3 flex items-center gap-4 p-2 justify-between">
                    <h3 class="text-xl font-semibold text-neutral-700 dark:text-neutral-400">Cache config</h3>
                    <button class="btn-small-blue" wire:click="clearCache('config')">Limpar</button>
                </div>
            </div>

            <hr class="border-gray-100 dark:border-gray-700 my-3">

            <h3 class="text-xl font-bold dark:text-neutral-300">Temporários</h3>
            <div class="flex flex-col w-max">
                <div class="mt-3 flex items-center gap-4 p-2 justify-between">
                    <h3 class="text-xl font-semibold text-neutral-700 dark:text-neutral-400">Imagens temporárias</h3>
                    <button class="btn-small-blue" wire:click="clearTempFolder()">Limpar</button>
                </div>
                <span class="text-sm text-neutral-800 dark:text-neutral-300">Arquivos temporários: {{$tempFilesCount}}</span>
            </div>
        </div>

        <div role="tabpanel" class="{{$tab === 'integrations' ? '' : 'hidden'}}">
            <h2 class="text-2xl font-bold dark:text-neutral-300">Integrações</h2>
            <div class="mt-3 items-center space-y-4 p-2">
                <h3 class="text-xl font-semibold dark:text-neutral-400">Instagram</h3>
                <div class="flex items-center gap-x-2">
                    <label for="instagram-api-key" class="text-md font-semibold text-neutral-700 dark:text-neutral-400">Api key</label>
                    <div class="w-full lg:w-6/12"><input type="text" class="text-input-default" id="instagram-api-key" wire:model.blur="instagramApiKey"></div>
                </div>
                @error('instagramApiKey')
                <span class="text-red-600">{!!$message!!}</span>
                @enderror

                <div class="flex items-center gap-x-2">
                    <label for="instagram-user-id" class="text-md font-semibold text-neutral-700 dark:text-neutral-400">User ID</label>
                    <div class="w-full lg:w-6/12"><input type="text" class="text-input-default" id="instagram-user-id" wire:model.blur="instagramUserId"></div>
                </div>
                @error('instagramUserId')
                <span class="text-red-600">{!!$message!!}</span>
                @enderror
            </div>
        </div>

        <div role="tabpanel" class="{{$tab === 'users' ? '' : 'hidden'}}">
            <h2 class="text-2xl font-bold dark:text-neutral-300">Usuários</h2>
            <div class="mt-3 items-center space-y-4 p-2">
                @forelse($users as $user)
                    <div class="rounded-xl bg-neutral-200 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-400 p-3 px-5 flex justify-between">
                        <span>{{$user->name}} <span class="text-neutral-500 text-xs">Cargo: {{$user->role}}</span></span>
                        <span class="text-red-400 text-lg cursor-pointer" wire:click="deleteUser({{$user->id}})" wire:confirm="Tem certeza que quer deletar esse usuário?"><ion-icon wire:ignore name="trash"></ion-icon></span>
                    </div>
                @empty
                    <span class="text-neutral-400">Sem usuários</span>
                @endforelse
            </div>
        </div>

    </div>
</div>