@extends('layouts.admin-master')
@section('admin-content')
@section('orders') active show-sub @endsection
@section('pending-orders','active')



 
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">ASM</a>
        <span class="breadcrumb-item active">Pending Orders</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
            <div class="col-md-12">
                <div class="card pd-20 pd-sm-40">
                    <div class="card-header">
                      <strong>Pending Order List</strong> 
                    </div>
                    <div class="card-body">
          
                    <div class="table-wrapper">
                      <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                          <tr>
                            <th class="wd-30p">Date</th>
                            <th class="wd-25p">Invoice</th>
                            <th class="wd-25p">Amount</th>
                            <th class="wd-25p">Tnx ID</th>
                            <th class="wd-25p">Status</th>
                            <th class="wd-25p">Status</th>
                          
                
                            <th class="wd-20p">Action</th> 
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                            <tr>
                           
                                <td>{{ $item->order_date }}</td>
                                <td>{{ $item->invoice_no }}</td>
                                <td>{{ $item->amount }}Tk</td>
                                <td>{{ $item->transaction_id }}</td>
                                <td>

                                 <span class="badge badge-pill badge-primary">{{ $item->status }}</span>
         
                                  </td>
                           <td>
                               <a href="{{ url('admin/orders-view/'.$item->id) }}" class="btn btn-primary" title="View Data"><i class="fa fa-eye"></i></a>
                               <a href="{{ url('admin/pending/orders-delete/'.$item->id) }}" class="btn btn-danger" title="delete data" id="delete"><i class="fa fa-trash"></i></a>
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
