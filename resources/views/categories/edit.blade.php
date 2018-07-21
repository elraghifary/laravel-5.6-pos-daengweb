@extends('layouts.master')

@section('title')
    <title>PoS - Category Management</title>
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    @card
                        @slot('card_title')
                            Edit
                        @endslot
                
                        @if (session('error'))
                            @alert(['type' => 'danger'])
                                {!! session('error') !!}
                            @endalert
                        @endif
​
                        <form role="form" action="{{ route('category.update', $categories->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="name">Category</label>
                                <input type="text" 
                                name="name"
                                value="{{ $categories->name }}"
                                class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="5" rows="5" class="form-control {{ $errors->has('description') ? 'is-invalid':'' }}">{{ $categories->description }}</textarea>
                            </div>
                            @slot('card_footer')
                                <div class="card-footer">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </form>
                            @endslot
                    @endcard    
                </div>
            </div>
        </div>
    </div>
@endsection