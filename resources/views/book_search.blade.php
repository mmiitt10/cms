@extends('layouts.app')

@section('slot')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <form method="GET" action="{{ route('book.search.result') }}" class="mb-0">
            <div class="mb-4">
                <x-input-label for="search" :value="__('書籍名または著者名で検索')" />
                <x-text-input id="search" class="block mt-1 w-full" type="text" name="search" placeholder="（例）プロダクトマネジメント" :value="old('search')" required autofocus />
                <x-input-error :messages="$errors->get('search')" class="mt-2" />
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-3">
                    {{ __('検索') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection
