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
        <span class="breadcrumb-item active">Dashboard</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
            <div class="col-md-10 m-auto">
                <div class="card pd-20 pd-sm-40">
                    <div class="card-header">
                      <strong> Role List</strong> 
                    </div>
                    <div class="card-body">
          
                    <div class="table-wrapper">
                      <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                          <tr>
                            <th class="wd-30p">SL</th>
                            <th class="wd-25p">Name</th>
                          
                
                            <th class="wd-20p">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $item)
                            <tr>
                   
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                           <td>
                               <a href="{{ route('role.edit',$item->id) }}" class="btn btn-primary" title="Edit Data"><i class="fa fa-pencil"></i></a>
                               <form action="{{ route('role.destroy',$item->id) }}" method="POST">
                                @csrf
                                @method('delete')
                               <button class="btn btn-sm-danger" title="delete data"><i class="fa fa-trash"></i></button>
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
