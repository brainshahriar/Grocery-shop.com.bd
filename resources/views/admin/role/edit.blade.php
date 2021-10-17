@extends('layouts.admin-master')
@section('admin-content')
@section('role')
    active show-sub
@endsection
@section('all-role')
    active
@endsection


 
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">WinBird</a>
        <span class="breadcrumb-item active">Edit Role</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
  
            <div class="col-md-12 m-auto">
                <div class="card">
                    <div class="card-header"> Add New role </div>
                        <div class="card-body">
                            <form action="{{ route('role.update',$role->id) }}" method="POST" >
                                @csrf
                                @method('put')
                                <div class="form-group">
                                  <label class="form-control-label">Role Name: <span class="tx-danger">*</span></label>
                                  <input class="form-control" type="text" name="name" value="{{$role->name}}" placeholder="Enter">
                                  @error('name')
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                </div>
        
                                <div class="form-layout-footer">
                                  <button type="submit" class="btn btn-info">Update</button>
                                </div><!-- form-layout-footer -->
                              </form>
                        </div>
                  
                </div>
           
            </div>
        </div>
      </div>

    </div>
@endsection
