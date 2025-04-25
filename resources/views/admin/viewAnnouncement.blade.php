<x-app-layout>
<link href="/src/styles.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@include('admin.css')
@include('admin.script')


<div class=" container-scroller w-full" style=" background-color: #FAEBD7;">
        @include('admin.sidebar')
        @include('admin.navbar')
<div class=" main-panel w-full h-full">
<div class="content-wrapper flex flex-col" style="background-color: #FAEBD7;">
<div class="justify-center p-6 flex-wrap gap-3 md:flex-row md:items-center flex w-full items-center" style="justify-content: space-between;">
<h1 class="text-black">test</h1>
</div>
</div>
</div>
</div>
</x-app-layout>