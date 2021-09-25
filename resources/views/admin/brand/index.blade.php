@extends('layouts.admin-master')
@section('brand','active')


 
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">WinBird</a>
        <span class="breadcrumb-item active">Dashboard</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
            <div class="col-md-8">
                <div class="card pd-20 pd-sm-40">
                    <div class="card-header">
                      <strong> Brand List</strong> 
                    </div>
                    <div class="card-body">
          
                    <div class="table-wrapper">
                      <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                          <tr>
                            <th class="wd-30p">Brand Image</th>
                            <th class="wd-25p">Brand Name English</th>
                            <th class="wd-25p">Brand Name Bangla</th>
                          
                
                            <th class="wd-20p">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($brand as $item)
                            <tr>
                                <td>
                                    <img src="{{ asset($item->brand_image) }}" alt="" style="width: 80px">
                                </td>
                                <td>{{ $item->brand_name_en }}</td>
                                <td>{{ $item->brand_name_bn }}</td>
                           <td>
                               <a href="{{ url('admin/brand-edit/'.$item->id) }}" class="btn btn-primary" title="Edit Data"><i class="fa fa-pencil"></i></a>
                               <a href="{{ url('admin/brand-delete/'.$item->id) }}" class="btn btn-danger" title="delete data" id="delete"><i class="fa fa-trash"></i></a>
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
                    <div class="card-header"> Add New Brand </div>
                        <div class="card-body">
                            <form action="{{ route('brand-store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                  <label class="form-control-label">Brand Name English: <span class="tx-danger">*</span></label>
                                  <input class="form-control" type="text" name="brand_name_en" value="{{ old('brand_name_en') }}" placeholder="Enter brand_name_en">
                                  @error('brand_name_en')
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                </div>
            
                                <div class="form-group">
                                  <label class="form-control-label">Brand Name Bangla: <span class="tx-danger">*</span></label>
                                  <input class="form-control" type="text" name="brand_name_bn" value="{{ old('brand_name_bn') }}" placeholder="Enter brand_name_bn">
                                  @error('brand_name_bn')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
            
                                <div class="form-group">
                                  <label class="form-control-label">Brand Image: <span class="tx-danger">*</span></label>
                                  <input class="form-control" type="file" name="brand_image" placeholder="Enter brand_name_bn">
                                  @error('brand_image')
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

