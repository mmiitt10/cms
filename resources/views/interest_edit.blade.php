@extends('layouts.app')

@section('slot')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <form action="{{ route('interest.update',  ['interest' => auth()->user()->interest->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-input-label for="interest_industry1" :value="__('興味がある業界1(必須)')" />
                <x-text-input id="interest_industry1" class="block mt-1 w-full" type="text" name="interest_industry1" value="{{ $interest->interest_industry1 }}" required autofocus />
                <x-input-error :messages="$errors->get('interest_industry1')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="interest_industry2" :value="__('興味がある業界2(任意)')" />
                <x-text-input id="interest_industry2" class="block mt-1 w-full" type="text" name="interest_industry2" value="{{ $interest->interest_industry2 }}" />
                <x-input-error :messages="$errors->get('interest_industry2')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="interest_industry3" :value="__('興味がある業界3(任意)')" />
                <x-text-input id="interest_industry3" class="block mt-1 w-full" type="text" name="interest_industry3" value="{{ $interest->interest_industry3 }}" />
                <x-input-error :messages="$errors->get('interest_industry3')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="interest_function1" :value="__('興味がある職種1(必須)')" />
                <x-text-input id="interest_function1" class="block mt-1 w-full" type="text" name="interest_function1" value="{{ $interest->interest_function1 }}" />
                <x-input-error :messages="$errors->get('interest_function1')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="interest_function2" :value="__('興味がある職種2(任意)')" />
                <x-text-input id="interest_function2" class="block mt-1 w-full" type="text" name="interest_function2" value="{{ $interest->interest_function2 }}" />
                <x-input-error :messages="$errors->get('interest_function2')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="interest_function3" :value="__('興味がある職種3(任意)')" />
                <x-text-input id="interest_function3" class="block mt-1 w-full" type="text" name="interest_function3" value="{{ $interest->interest_function3 }}" />
                <x-input-error :messages="$errors->get('interest_function3')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('更新') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection
