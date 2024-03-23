@extends('layouts.app')

@section('slot')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <form method="POST" action="{{ route('uinfo.update', ['uinfo' => auth()->user()->uinfo->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-input-label for="profile_name" :value="__('名前')" />
                <x-text-input id="profile_name" class="block mt-1 w-full" type="text" name="profile_name" value="{{ $uinfo->profile_name }}" required autofocus />
                <x-input-error :messages="$errors->get('profile_name')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="profile_age" :value="__('年齢')" />
                <x-text-input id="profile_age" class="block mt-1 w-full" type="number" name="profile_age" value="{{ $uinfo->profile_age }}" />
                <x-input-error :messages="$errors->get('profile_age')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="profile_picture" :value="__('プロフィール画像')" />
                <x-text-input id="profile_picture" class="block mt-1 w-full" type="file" name="profile_picture" />
                <img src="{{ asset('storage/'. $uinfo->profile_picture) }}" alt="Profile Picture" class="mt-2" style="width: 100px; height: auto;">
                <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="profile_intro" :value="__('自己紹介')" />
                <textarea id="profile_intro" name="profile_intro" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="4">{{ $uinfo->profile_intro }}</textarea>
                <x-input-error :messages="$errors->get('profile_intro')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('更新') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection
