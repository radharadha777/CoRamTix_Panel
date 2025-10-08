@extends('layouts.designify', ['sideEditor' => true])

@section('title')
    Color Settings
@endsection

@section('content')
<form action="{{ route('admin.designify.colors') }}" method="POST" class="h-full flex flex-col">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white mb-2">Color settings</h1>
        <p class="text-zinc-400 text-sm">Change the color scheme of CoRamTix Theme.</p>
    </div>
<div class="flex-1 space-y-6 pb-[80px]">
    <div class="space-y-4">
                <h3 class="text-lg font-bold text-zinc-200 mb-1">Basic Colors</h3>              
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label for="coramtix:colorPrimary" class="block text-sm font-medium text-zinc-300">Primary</label>
                        <div class="flex items-center space-x-2">
                            <input 
                                type="color" 
                                class="h-10 w-16 rounded border border-zinc-600 bg-zinc-700 cursor-pointer" 
                                name="coramtix:colorPrimary" 
                                id="coramtix:colorPrimary"
                                value="{{ old('coramtix:colorPrimary', $colorPrimary) }}" 
                            />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="coramtix:colorSuccess" class="block text-sm font-medium text-zinc-300">Success</label>
                        <div class="flex items-center space-x-2">
                            <input 
                                type="color" 
                                class="h-10 w-16 rounded border border-zinc-600 bg-zinc-700 cursor-pointer" 
                                name="coramtix:colorSuccess" 
                                id="coramtix:colorSuccess"
                                value="{{ old('coramtix:colorSuccess', $colorSuccess) }}" 
                            />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="coramtix:colorDanger" class="block text-sm font-medium text-zinc-300">Danger</label>
                        <div class="flex items-center space-x-2">
                            <input 
                                type="color" 
                                class="h-10 w-16 rounded border border-zinc-600 bg-zinc-700 cursor-pointer" 
                                name="coramtix:colorDanger" 
                                id="coramtix:colorDanger"
                                value="{{ old('coramtix:colorDanger', $colorDanger) }}" 
                            />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="coramtix:colorSecondary" class="block text-sm font-medium text-zinc-300">Secondary</label>
                        <div class="flex items-center space-x-2">
                            <input 
                                type="color" 
                                class="h-10 w-16 rounded border border-zinc-600 bg-zinc-700 cursor-pointer" 
                                name="coramtix:colorSecondary" 
                                id="coramtix:colorSecondary"
                                value="{{ old('coramtix:colorSecondary', $colorSecondary) }}" 
                            />
                        </div>
                    </div>
                </div>
                <div class="border-t border-zinc-700"></div>
                <div>
                    <h3 class="text-lg font-bold text-zinc-200 mb-1">Default colors</h3>                   
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ([50,100,200,300,400,500,600,700,800,900] as $shade)
                        <div class="space-y-2">
                            <label for="coramtix:color{{ $shade }}" class="block text-sm font-medium text-zinc-300">Gray {{ $shade }}</label>
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="color" 
                                    class="h-10 w-16 rounded border border-zinc-600 bg-zinc-700 cursor-pointer" 
                                    name="coramtix:color{{ $shade }}" 
                                    id="coramtix:color{{ $shade }}"
                                    value="{{ old('coramtix:color'.$shade, ${'color'.$shade}) }}" 
                                />
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                @foreach (range(1,7) as $theme)
                    @php
                        $themeVar = 'theme' . $theme;
                    @endphp
                    <div class="border-t border-zinc-700"></div>
                    <div>
                        <h3 class="text-lg font-bold text-zinc-200 mb-1">Theme{{ $theme }} Settings</h3>                   
                        <div class="space-y-3 mb-3">
                            <label class="block text-sm font-medium text-zinc-300" for="coramtix:theme{{ $theme }}:name">
                                Theme{{ $theme }} Name
                            </label>
                            <input
                                type="text"
                                id="coramtix:theme{{ $theme }}:name"
                                name="coramtix:theme{{ $theme }}:name"
                                value="{{ old("coramtix:theme{$theme}:name", ${$themeVar}['name'] ?? '') }}"
                                class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                placeholder="Theme{{ $theme }} Display name"
                            />
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-zinc-300" for="coramtix:theme{{ $theme }}:colorPrimary">
                                    Theme{{ $theme }} Primary
                                </label>
                                <div class="flex items-center space-x-2">
                                    <input
                                        type="color"
                                        id="coramtix:theme{{ $theme }}:colorPrimary"
                                        name="coramtix:theme{{ $theme }}:colorPrimary"
                                        value="{{ old("coramtix:theme{$theme}:colorPrimary", ${$themeVar}['colorPrimary'] ?? '') }}"
                                        class="h-10 w-16 rounded border border-zinc-600 bg-zinc-700 cursor-pointer"
                                    />
                                </div>
                            </div>

                            @foreach ([50,100,200,300,400,500,600,700,800,900] as $shade)
                            <div class="space-y-2">
                                <label for="coramtix:theme{{ $theme }}:color{{ $shade }}" class="block text-sm font-medium text-zinc-300">
                                    Theme{{ $theme }} {{ $shade }}
                                </label>
                                <div class="flex items-center space-x-2">
                                    <input 
                                        type="color" 
                                        class="h-10 w-16 rounded border border-zinc-600 bg-zinc-700 cursor-pointer" 
                                        name="coramtix:theme{{ $theme }}:color{{ $shade }}" 
                                        id="coramtix:theme{{ $theme }}:color{{ $shade }}"
                                        value="{{ old("coramtix:theme{$theme}:color{$shade}", ${$themeVar}['color'.$shade] ?? '') }}" 
                                    />
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
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