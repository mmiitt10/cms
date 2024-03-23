<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="text-center">
            <p class="mt-4">興味がある業界1: <span class="font-bold">{{ auth()->user()->interest->interest_industry1 }}</span></p>
            <p>興味がある業界2: <span class="font-bold">{{ auth()->user()->interest->interest_industry2 }}</span></p>
            <p>興味がある業界3: <span class="font-bold">{{ auth()->user()->interest->interest_industry3 }}</span></p>
            <p>興味がある職種1: <span class="font-bold">{{ auth()->user()->interest->interest_function1 }}</span></p>
            <p>興味がある職種2: <span class="font-bold">{{ auth()->user()->interest->interest_function2 }}</span></p>
            <p>興味がある職種3: <span class="font-bold">{{ auth()->user()->interest->interest_function3 }}</span></p>
            
            <a href="{{ route('interest.edit', ['interest' => auth()->user()->interest->id]) }}" class="inline-block mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">編集</a>
        </div>
    </div>
</div>
