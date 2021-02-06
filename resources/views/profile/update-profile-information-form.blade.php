<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('プロフィールを変更') }}
    </x-slot>

    <x-slot name="description">
        {{ __('おすすめの旅先など、あなたのプロフィールをみんなにシェアしましょう！') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('プロフィール写真') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('写真を選ぶ') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('写真を削除') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('名前') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('メールアドレス') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

        {{-- age --}}
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="age" value="{{ __('年代') }}" />
            <div class="form-input">
                <select id="age" type="text" class="mt-1 block w-full" wire:model.defer="state.age">
                    <option value="" selected>選択してください</option>
                    <option value="10代">10代</option>
                    <option value="20代">20代</option>
                    <option value="30代">30代</option>
                    <option value="40代">40代</option>
                    <option value="50代">50代</option>
                    <option value="60代">60代</option>
                    <option value="70代">70代</option>
                    <option value="80代">80代</option>
                </select>
            </div>
            <x-jet-input-error for="age" class="mt-2" />
        </div>

        {{-- sex --}}
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="sex" value="{{ __('性別') }}" />
            <div class="form-input">
                <select id="sex" type="text" class="mt-1 block w-full" wire:model.defer="state.sex">
                    <option value="" selected>選択してください</option>
                    <option value="男性">男性</option>
                    <option value="女性">女性</option>
                </select>
            </div>
            <x-jet-input-error for="sex" class="mt-2" />
        </div>

        {{-- recommendation --}}
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="recommendaition" value="{{ __('おすすめの旅先') }}" />
            <x-jet-input id="recommendation" type="text" class="mt-1 block w-full" wire:model.defer="state.recommendation" />
            <x-jet-input-error for="recommendation" class="mt-2" />
        </div>

        {{-- introduction --}}
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="introduction" value="{{ __('自己紹介') }}" />
            <div class="form-input">
                <textarea name="" id="introduction" cols="28" rows="8" type="text" class="mt-1 block w-full" wire:model.defer="state.introduction"></textarea>
            </div>
            <x-jet-input-error for="introduction" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('保存しました！') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('保存') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
