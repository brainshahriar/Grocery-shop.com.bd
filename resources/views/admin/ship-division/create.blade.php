@extends('layouts.admin-master')
@section('shipping') active show-sub @endsection
@section('add-division','active')

     <!-- ########## START: MAIN PANEL ########## -->
     <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">WinCart</a>
          <span class="breadcrumb-item active">Division</span>
        </nav>
  
        <div class="sl-pagebody">
          <div class="row row-sm">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">Division List</div>
                <div class="card-body">
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-30p">Division Name</th>
                        <th class="wd-20p">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($divisions as $item)
                      <tr>
                        <td>{{ $item->division_name }}</td>
                        <td>
                          <a href="{{ url('admin/division-edit/'.$item->id) }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i></a>

                          <a href="{{ url('admin/division-delete/'.$item->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- table-wrapper -->
              </div>
              </div><!-- card -->
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">Add Division</div>
                  <div class="card-body">
                <form action="{{ route('division-store') }}" method="POST">
                    @csrf
    

                    <div class="form-group">
                      <label class="form-control-label">Division Name: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="division_name" value="{{ old('division_name') }}" placeholder="Enter ">
                      @error('division_name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="form-layout-footer">
                      <button type="submit" class="btn btn-info">Create</button>
                    </div><!-- form-layout-footer -->
                  </form>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>

  