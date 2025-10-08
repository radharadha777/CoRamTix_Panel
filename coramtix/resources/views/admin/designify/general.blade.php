@extends('layouts.designify', ['sideEditor' => true])

@section('title')
    General Settings
@endsection

@section('content')
<form action="{{ route('admin.designify.general') }}" method="POST" class="h-full flex flex-col">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white mb-2">General settings</h1>
        <p class="text-zinc-400 text-sm">Change the general settings of CoRamTix Theme.</p>
    </div>
    <div class="flex-1 space-y-6">
        <div class="space-y-3">
            <label for="coramtix:logo" class="block text-sm font-medium text-zinc-300">
                Panel logo
            </label>
            <div class="relative">
                <input
                    type="text" 
                    id="coramtix:logo" 
                    name="coramtix:logo" 
                    value="{{ old('coramtix:logo', $logo) }}" 
                    class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Enter logo URL or path"
                />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <i class="fas fa-image text-zinc-400 text-sm"></i>
                </div>
            </div>
            <p class="text-xs text-zinc-500">
                Enter the URL or file path for your panel logo
            </p>
        </div>
    <div class="space-y-3">
        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300" for="coramtix:customCopyright">
            Custom Copyright
        </label>
        <select 
            name="coramtix:customCopyright" 
            id="coramtix:customCopyright"
            class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
        >
            <option value="true" {{ old('coramtix:customCopyright', $customCopyright) === 'true' ? 'selected' : '' }}>
                Enabled
            </option>
            <option value="false" {{ old('coramtix:customCopyright', $customCopyright) === 'false' ? 'selected' : '' }}>
                Disabled
            </option>
        </select>
                <input
                    type="text" 
                    id="coramtix:copyright" 
                    name="coramtix:copyright" 
                    value="{{ old('coramtix:copyright', $copyright) }}" 
                    class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Powered by [CoRamTix](https://revix.cc)"
                />
    </div>
    <div class="space-y-3 !mb-20">
        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300" for="coramtix:isUnderMaintenance">
            Maintenance
        </label>
        <select 
            name="coramtix:isUnderMaintenance" 
            id="coramtix:isUnderMaintenance"
            class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
        >
            <option value="true" {{ old('coramtix:isUnderMaintenance', $isUnderMaintenance) === 'true' ? 'selected' : '' }}>
                Enabled
            </option>
            <option value="false" {{ old('coramtix:isUnderMaintenance', $isUnderMaintenance) === 'false' ? 'selected' : '' }}>
                Disabled
            </option>
        </select>
                <input
                    type="text" 
                    id="coramtix:maintenance" 
                    name="coramtix:maintenance" 
                    value="{{ old('coramtix:maintenance', $maintenance) }}" 
                    class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Maintenance description."
                />
    </div>
    </div>
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[612px] rounded-xl sm:border border-zinc-700 bg-zinc-950/60 pt-2 mt-6 px-4 mb-2">
        <div class="flex items-center justify-between pb-2">
            <div class="hidden sm:block text-sm text-zinc-400">
                <i class="fas fa-info-circle mr-1"></i>
                Changes will be applied immediately after saving
            </div>
            <div class="flex items-center space-x-3">
                {!! csrf_field() !!}
                <button 
                    type="submit" 
                    class="px-6 py-2.5 bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-zinc-900 flex items-center space-x-2"
                >
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span class="hidden sm:block">Save changes</span>
                </button>
            </div>
        </div>
    </div>
</form>
@endsection