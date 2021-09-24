@extends('layouts.admin-master')


     <!-- ########## START: MAIN PANEL ########## -->
     <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">SHopMama</a>
          <span class="breadcrumb-item active">Brand Update</span>
        </nav>
  
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
              <h6 class="card-body-title">Update Brand</h6>
              <form action="{{ route('update-brand') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">
                <input type="hidden" name="id" value="{{ $brand->id }}">
            <div class="row row-sm">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-control-label">Brand Name English: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="brand_name_en" value="{{ $brand->brand_name_en }}" placeholder="Enter brand_name_en">
                            @error('brand_name_en')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                    </div>  
  
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-control-label">Brand Name Bangla: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="brand_name_bn" value="{{ $brand->brand_name_bn }}" placeholder="Enter brand_name_bn">
                            @error('brand_name_bn')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                          </div>
                    </div>  
                  
                  <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Brand Image: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="file" name="brand_image" placeholder="Enter brand_name_bn">
                        @error('brand_image')
                        <span class="text-danger">{{ $message }}</span>
                     @enderror
                      </div>
                  </div> 
              <div class="form-layout-footer mt-3">
                <button class="btn btn-info mg-r-5" type="submit" style="cursor: pointer;">Update Brand</button>
              </div><!-- form-layout-footer -->
            </form>
            </div>
            </div><!-- row --> 


    </div>

