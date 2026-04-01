@props(['leftIcon' => null])

<div x-data="{ show: false }" class="relative group">
    @if($leftIcon)
        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-300 group-focus-within:text-blue-600 transition-colors">
            {!! $leftIcon !!}
        </div>
    @endif
    
    <input 
        type="password"
        :type="show ? 'text' : 'password'" 
        {{ $attributes->merge(['class' => 'block w-full rounded-2xl border border-slate-100 bg-slate-50 py-4.5 text-sm font-semibold text-slate-700 placeholder:text-slate-300 input-focus transition-all ' . ($leftIcon ? 'pl-12' : 'px-6') . ' pr-12']) }}
    >
    
    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-5 flex items-center text-slate-300 hover:text-blue-600 transition-colors focus:outline-none">
        <!-- Eye Open (Hide Password) -->
        <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
        <!-- Eye Closed (Show Password) -->
        <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057-5.064-7 9.542-7 1.274 4.057 5.064 7 9.542 7 .847 2.702 2.532 5.02 4.675 6.675M9.88 9.88l4.24 4.24M3 3l18 18" />
        </svg>
    </button>
</div>
