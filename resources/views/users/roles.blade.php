@extends('layouts.master')
​
@section('title')
    <title>Set Role</title>
@endsection
​
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Set Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
                        <li class="breadcrumb-item active">Set Role</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
​
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('users.set_role', $user->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                    @card
                        @slot('card_title')
                            User Data
                        @endslot
                        
                        @if (session('success'))
                            @alert(['type' => 'success'])
                                {{ session('success') }}
                            @endalert
                        @endif
                        
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                    </tr>
                                    <tr>
                                        <th>Role</th>
                                        <td>
                                            @foreach ($roles as $row)
                                            <input type="radio" name="role" 
                                                {{ $user->hasRole($row) ? 'checked':'' }}
                                                value="{{ $row }}"> {{  $row }} <br>
                                            @endforeach
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        @slot('card_footer')
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm float-right">
                                    Set Role
                                </button>
                            </div>
                        @endslot
                    @endcard
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection