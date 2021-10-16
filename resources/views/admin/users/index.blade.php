@extends('layouts.admin-master')
@section('admin-content')


    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">ASM</a>
        <span class="breadcrumb-item active">All Users</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
            <div class="col-md-12">
                <div class="card pd-20 pd-sm-40">
                    <div class="card-header">
                      <strong> All User List</strong> 
                    </div>
                    <div class="card-body">
          
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap">
                            <thead>
                              <tr>
                                <th class="wd-15p">Image</th>
                                <th class="wd-15p">Name</th>
                                <th class="wd-20p">Phone</th>
                                <th class="wd-25p">Status</th>
                                <th class="wd-15p">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($users as $user)
                              <tr>
                                <td>
                                    <img src="{{ asset($user->image) }}" alt="" height="60px;" width="60px;">
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    <span class="badge badge-pill badge-success">Active</span>
                                </td>
                                <td>
                                  <a href="{{ url('admin/orders-view/'.$user->id) }}" class="btn btn-sm btn-primary" title="view data"> <i class="fa fa-eye"></i></a>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                    </div><!-- table-wrapper -->
                </div>
                  </div><!-- card -->
            </div>
        </div>
      </div>

    </div>
@endsection
