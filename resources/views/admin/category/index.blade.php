@extends('layouts.admin-master')
@section('categories') active show-sub @endsection
@section('add-category','active')

     <!-- ########## START: MAIN PANEL ########## -->
     <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">WinCart</a>
          <span class="breadcrumb-item active">Category</span>
        </nav>
  
        <div class="sl-pagebody">
          <div class="row row-sm">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">Category List</div>
                <div class="card-body">
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-30p">Category Icon</th>
                        <th class="wd-25p">Category name En</th>
                        <th class="wd-25p">Category name Bn</th>
                        <th class="wd-20p">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($categories as $item)
                      <tr>
                        <td>
                         <span><i class="{{ $item->category_icon }}"></i></span>
                        </td>
                        <td>{{ $item->category_name_en }}</td>
                        <td>{{ $item->category_name_bn }}</td>
                        <td>
                          <a href="{{ url('admin/category-edit/'.$item->id) }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i></a>

                          <a href="{{ url('admin/category-delete/'.$item->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>
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
                <div class="card-header">Add New Category</div>
                  <div class="card-body">
                <form action="{{ route('category-store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label class="form-control-label">Category Icon: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="category_icon" value="{{ old('brand_name_en') }}" placeholder="Enter category_icon">
                      @error('category_icon')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label class="form-control-label">Category Name English: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="category_name_en" value="{{ old('category_name_en') }}" placeholder="Enter brand_name_bn">
                      @error('category_name_en')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Category Name Bangla: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="category_name_bn" value="{{ old('category_name_bn') }}" placeholder="Enter brand_name_bn">
                        @error('category_name_bn')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                      </div>

                    <div class="form-layout-footer">
                      <button type="submit" class="btn btn-info">Category Add</button>
                    </div><!-- form-layout-footer -->
                  </form>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>

  