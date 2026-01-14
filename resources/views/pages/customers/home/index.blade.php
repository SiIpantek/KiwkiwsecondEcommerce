@extends('layouts.app')

@section('title', 'Beranda | E-Commerce')

@section('content')

    {{-- Hero --}}
    <main>
        @include('components.customers.beranda.hero')
    </main>

    {{-- Sections 2 - Category Showcase --}}
    <section>
        @include('components.customers.beranda.collection')
    </section>
@endsection
