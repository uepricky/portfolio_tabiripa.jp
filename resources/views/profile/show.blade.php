@extends('post.layout')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('マイページ') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />
            @endif

            {{-- @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border />
            @endif --}}

            {{-- <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            <x-jet-section-border /> --}}

            <div class="mt-10 sm:mt-0">
                @livewire('profile.delete-user-form')
            </div>

            <div class="hidden sm:block">
                <div class="py-8">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>

            <div class="favorite-post md:grid md:grid-cols-3 md:gap-6">
                <div class="px-4 sm:px-0">
                    <h3 class="btn btn-success text-lg font-medium" id="favoriteButton">お気に入りした投稿</h3>
                    <p class="mt-1 text-sm text-gray-600">お気に入りに保存した投稿を見る。</p>
                </div>
                
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg" style="display: flex; flex-wrap: wrap;">
                        @if (!empty($favorites))
                            @foreach ($favorites as $favorite)
                                <div class="col-xs-12 col-sm-4 popularityPost">
                                    <div class="card">
                                        <a class="img-card" href="{{ route('postShow', ['post_id' => $favorite[0]->post_main_id]) }}">
                                            <div class="subImg">
                                                <img src="{{asset('storage/postedImages/'.$favorite[0]->photo)}}" />
                                            </div>
                                        </a>
                                        <p></p>
                                        <div class="card-content">
                                            <h5 class="card-title">
                                                <a href="{{ route('postShow', ['post_id' => $favorite[0]->post_main_id]) }}">
                                                    {{ Str::limit($favorite[0]->title, 58) }}
                                                </a>
                                            </h5>
                                            @if (mb_strlen($favorite[0]->title) < 15)
                                                <br>
                                            @endif
                                            <div style="display:flex; justify-content: space-between;">
                                                <div style="padding-bottom: 0rem">
                                                    <span style="float: left;">
                                                        <img src="{{$favorite[0]->user->profile_photo_url}}" alt="{{$favorite[0]->user->name}}" class="favorite-user-img">
                                                        <div>
                                                            {{ $favorite[0]->user->name }}
                                                        </div>
                                                    </span>
                                                </div>
                                                <div>
                                                    <small class="text-muted">{{$favorite[0]->area}}</small>
                                                
                                                    <div>
                                                        @php
                                                            $postDate = $favorite[0]->created_at;
                                                            $showPostDate = substr($postDate, 0, strlen($postDate)-9);
                                                        @endphp
                                                        <small class="text-muted">{{$showPostDate}}</small>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="card-read-more">
                                            <a href="{{ route('postShow', ['post_id' => $favorite[0]->post_main_id]) }}" class="btn btn-link btn-block">
                                                もっと見る
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            
                        @else
                            <p>お気に入りした投稿はまだありません。</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>    
</x-app-layout>

<style>
    .favorite:hover {
        opacity: 0.7;
    }
    #between_layout_contant{
        padding-top: 0rem;
    }
    .title-font {
        font-size: 35px;
    }
    .favorite-user-img {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
    }
</style>

@endsection