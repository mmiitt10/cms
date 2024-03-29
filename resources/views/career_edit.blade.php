@extends('layouts.app')

@section('slot')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <form action="{{ route('career.update', ['career' => $career->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-input-label for="career_company" :value="__('会社名')" />
                <x-text-input id="career_company" class="company_name block mt-1 w-full" type="text"  name="career_company" value="{{ $career->career_company }}" required autofocus />
                <x-input-error :messages="$errors->get('career_company')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="career_work_from" :value="__('入社時期')" />
                <x-text-input id="career_work_from" class="block mt-1 w-full" type="date" name="career_work_from" value="{{ $career->career_work_from }}" />
                <x-input-error :messages="$errors->get('career_work_from')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="career_work_to" :value="__('退社時期')" />
                <x-text-input id="career_work_to" class="block mt-1 w-full" type="date" name="career_work_to" value="{{ $career->career_work_to }}" />
                <x-input-error :messages="$errors->get('career_work_to')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="career_industry" :value="__('業界')" />
                <x-text-input id="career_industry" class="block mt-1 w-full" type="text" name="career_industry" value="{{ $career->career_industry }}" />
                <x-input-error :messages="$errors->get('career_industry')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="career_function" :value="__('職種')" />
                <x-text-input id="career_function" class="block mt-1 w-full" type="text" name="career_function" value="{{ $career->career_function }}" />
                <x-input-error :messages="$errors->get('career_function')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="career_position" :value="__('役職')" />
                <x-text-input id="career_position" class="block mt-1 w-full" type="text" name="career_position" value="{{ $career->career_position }}" />
                <x-input-error :messages="$errors->get('career_position')" class="mt-2" />
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
