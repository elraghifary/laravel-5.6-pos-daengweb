@extends('layouts.master')

@section('title')
    <title>PoS - Role Management</title>
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Role Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Role</li>
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
                            <a href="#" 
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        @endslot
                        
                        @if (session('success'))
                            @alert(['type' => 'success'])
                                {!! session('success') !!}
                            @endalert
                        @endif
                        
                        <form role="form" action="{{ route('role.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Role</label>
                                <input type="text" 
                                name="name"
                                class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" id="name" required>
                            </div>
                        @slot('card_footer')
                            <div class="card-footer">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        @endslot
                    @endcard
                </div>
                <div class="col-md-8">
                    @card
                        @slot('card_title')
                        List Role
                        @endslot
                        
                        @if (session('success'))
                            @alert(['type' => 'success'])
                                {!! session('success') !!}
                            @endalert
                        @endif
                        
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Role</td>
                                        <td>Guard</td>
                                        <td>Created At</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @forelse ($roles as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->guard_name }}</td>
                                        <td>{{ $row->created_at }}</td>
                                        <td>
                                            <form action="{{ route('role.destroy', $row->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No records found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
​
                        <div class="float-right">
                            {!! $roles->links() !!}
                        </div>
                        @slot('card_footer')
​
                        @endslot
                    @endcard
                </div>
            </div>
        </div>
    </section>
</div>
@endsection