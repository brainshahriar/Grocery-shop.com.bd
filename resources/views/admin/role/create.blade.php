@extends('layouts.admin-master')
@section('admin-content')
@section('role')
    active show-sub
@endsection
@section('add-role')
    active
@endsection


 
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">WinBird</a>
        <span class="breadcrumb-item active">Add New Role</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
  
            <div class="col-md-12 m-auto">
                <div class="card">
                    <div class="card-header"> Add New role </div>
                        <div class="card-body">
                            <form action="{{ route('role.store') }}" method="POST" >
                                @csrf
                                <div class="form-group">
                                  <label class="form-control-label">Role Name: <span class="tx-danger">*</span></label>
                                  <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Enter">
                                  @error('name')
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                </div>
        
                                <div class="form-layout-footer">
                                  <button type="submit" class="btn btn-info">Add New</button>
                                </div><!-- form-layout-footer -->
                              </form>
                        </div>
                  
                </div>
           
            </div>
        </div>
      </div>

    </div>
@endsection
