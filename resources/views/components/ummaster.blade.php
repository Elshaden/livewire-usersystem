@extends('vendor@livewire::layouts.app')

@push('styles')
@endpush

@section('content')
    <div class="min-h-screen bg-gray-50" dir="rtl">



    <!-- Page Heading -->


        <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50" dir="rtl">

        @include('appSection@livewire::layouts.partials.navigation')

        <!-- Page Heading -->


            <!-- Page Content -->
            <main>
                <div class="py-5 max-w-6xl mx-auto font-arabic">
                      <div>
                    {{ $slot }}
                      </div>

                </div>
            </main>
        </div>




@endsection
