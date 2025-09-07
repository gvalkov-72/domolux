@extends('frontend.EstateAgency.layouts.app')

@section('title', $page->translate()->title . ' - Домо Лукс')

@section('content')

<!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>{{ $page->translate()->title }}</h1>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row d-flex">
            <div class="col-lg-8">
              <p>{!! $page->translate()->content !!}</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">About</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

@endsection

