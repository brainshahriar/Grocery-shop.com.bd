@extends('layouts.admin-master')
@section('admin-content')
@section('subadmin') active show-sub @endsection
@section('all-subadmin') active @endsection

     <!-- ########## START: MAIN PANEL ########## -->
     <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">SHopMama</a>
          <span class="breadcrumb-item active">Dashboard</span>
        </nav>
        <div class="sl-pagebody">
          <div class="row row-sm">
            <div class="col-md-10 m-auto">
              <div class="card">
                <div class="card-header">Subadmin List</div>
                <div class="card-body">
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-30p">Sl</th>
                        <th class="wd-25p">Name</th>
                        <th class="wd-25p">Email</th>
                        <th class="wd-25p">Role</th>
                        <th class="wd-20p">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $item)
                      <tr>

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <span class="badge badge-pill badge-success">{{ $item->role->name }}</span>
                        </td>
                        <td>
                          <a href="{{ route('subadmin.edit',$item->id) }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i></a>
                        <form action="{{ route('subadmin.destroy',$item->id) }}" method="POST">
                            @csrf
                            @method('delete')
                          <button class="btn btn-sm btn-danger"  title="delete data"><i class="fa fa-trash"></i></button>
                        </form>
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