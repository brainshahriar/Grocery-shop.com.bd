@extends('layouts.admin-master')
@section('sliders')
    active
@endsection

     <!-- ########## START: MAIN PANEL ########## -->
     <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">SHopMama</a>
          <span class="breadcrumb-item active">Slider</span>
        </nav>
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
              <h6 class="card-body-title">Update Slider</h6>
              <form action="{{ route('update-slider') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="old_image" value="{{ $slider->image }}">
                <input type="hidden" name="id" value="{{ $slider->id }}">
            <div class="row row-sm">
                @if ($slider->title_en == NULL)
                @else
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-control-label">Slider Title English: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="title_en" value="{{ $slider->title_en }}" placeholder="Enter slider title English">
                          </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-control-label">Slider Title Bangla: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="title_bn" value="{{ $slider->title_bn }}" placeholder="Enter slider title Bangla">
                          </div>
                    </div>

                  <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">SLider Description English: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="description_en" value="{{ $slider->description_en }}" placeholder="Enter description English">
                      </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">SLider Description Bangla: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="description_bn" value="{{ $slider->description_bn }}" placeholder="Enter description Bangla">
                      </div>

                  </div>
                @endif

                  <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Slider Image: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="file" name="image" placeholder="Enter brand_name_bn">
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                     @enderror
                      </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Old Image: <span class="tx-danger">*</span></label>
                        <img src="{{ asset($slider->image) }}" height="60px" width="150px;" alt="">
                      </div>
                  </div>
              <div class="form-layout-footer mt-3">
                <button class="btn btn-info mg-r-5" type="submit" style="cursor: pointer;">Update Slider</button>
              </div><!-- form-layout-footer -->
            </form>
            </div>
            </div><!-- row -->


    </div>

