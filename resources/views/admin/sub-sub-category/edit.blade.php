@extends('layouts.admin-master')

@section('categories') active show-sub @endsection
@section('subsubcategory') active @endsection

     <!-- ########## START: MAIN PANEL ########## -->
     <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">SHopMama</a>
          <span class="breadcrumb-item active">Sub-Sub-Category</span>
        </nav
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
              <h6 class="card-body-title">Update Sub-Sub-Category</h6>
              <form action="{{ route('update-sub-subcategory') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $subsubcat->id }}">
            <div class="row row-sm">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-control-label">Sub-Sub-Category Name English: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="subsubcategory_name_en" value="{{ $subsubcat->subsubcategory_name_en }}" placeholder="Enter subcategory name en">
                            @error('subsubcategory_name_en')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                          </div>
      
                    </div>  
  
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-control-label">sub-Category Name Bangla: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="subsubcategory_name_bn" value="{{ $subsubcat->subsubcategory_name_bn }}" placeholder="Enter subcategory name bn">
                            @error('subsubcategory_name_bn')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                          </div>
                    </div>  
              <div class="form-layout-footer mt-3">
                <button class="btn btn-info mg-r-5" type="submit" style="cursor: pointer;">Update Data</button>
              </div><!-- form-layout-footer -->
            </form>
            </div>
            </div><!-- row --> 


    </div>

