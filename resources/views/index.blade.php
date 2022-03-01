@extends('layouts.Main_Dashboard')

@section('Main_Content')
<main id="main">
    {{-- Bagian Opening Index --}}
    <section id="section-opening" class="bg-img">
        <div class="card text-center">
            <div class="card-header">
            </div>
            <div class="card-body">
              <h5 class="card-title">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <form action="{{ route('Antrian.Mendonor') }}" method="post">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Go Somewhere</button>
              </form>
            </div>
            <div class="card-footer text-muted">
              2 days ago
            </div>
          </div>
    </section>
</main>
@endsection