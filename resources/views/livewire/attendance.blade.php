<div>
    <input type="hidden" name="lat" wire:model="lat">
    <input type="hidden" name="lng" wire:model="lng">
    @if(!$isTimeIn)
        <button type="submit" wire:click="timeIn()" {{ $disabled ? 'disabled' : null }}
                class="inline-flex items-center justify-center py-3 px-6 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-theme-1 hover:bg-theme-1 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out disabled:opacity-50">
            <span>Time In</span>
        </button>
    @else
        <button type="submit" wire:click="timeOut()" {{ $disabled ? 'disabled' : null }}
                class="inline-flex items-center justify-center py-3 px-6 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out disabled:opacity-50">
            <span>Time Out</span>
        </button>
    @endif
</div>
