@extends('layouts.designify', ['sideEditor' => false])

@section('title')
    Home
@endsection

@section('content')
<div class="h-full flex flex-col">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white mb-2">Welcome to Designify</h1>
        <p class="text-zinc-400 text-sm">To begin configuring, use Sidebar to navigate between options.</p>
    </div>
<section class="mb-8">
  <div>
    <div class="bg-orange-600/10 border border-orange-600 rounded-lg shadow">
      <div class="border-b border-orange-600 px-4 py-2">
        <h3 class="text-lg font-semibold text-orange-600">System Information</h3>
      </div>
      <div class="px-4 py-3 text-orange-200">
        You are running CoRamTix Panel version <code class="px-1 py-0.5 border border-orange-800 rounded text-sm">v{{ config('app.version') }}</code>. 
      </div>
    </div>
  </div>

  <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6">
    <div class="text-center">
      <a href="https://discord.gg/ZrRsNKK94R">
        <button class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded shadow">
          <i class="fa-brands fa-discord"></i>
          Get Help <small class="text-xs">(via Discord)</small>
        </button>
      </a>
    </div>

    <div class="text-center">
      <a href="https://docs.revix.cc/">
        <button class="w-full px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded shadow">
          <i class="fa-solid fa-book"></i>
          Documentation
        </button>
      </a>
    </div>

    <div class="text-center">
      <a href="https://github.com/revixlabs/coramtix">
        <button class="w-full px-4 py-2 bg-zinc-600 hover:bg-zinc-700 text-white font-medium rounded shadow">
          <i class="fa-brands fa-github"></i>
          GitHub
        </button>
      </a>
    </div>

    <div class="text-center">
      <a href="https://revix.cc/donate">
        <button class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded shadow">
          <i class="fa-solid fa-heart"></i>
          Support the Project
        </button>
      </a>
    </div>
  </div>
</section>

</div>
@endsection