@extends('layouts.admin-master')
@section('admin-content')
@section('shipping') active show-sub @endsection
@section('add-state') active @endsection

     <!-- ########## START: MAIN PANEL ########## -->
     <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">SHopMama</a>
          <span class="breadcrumb-item active">state</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
            <div class="col-md-6 m-auto">
              <div class="card">
                <div class="card-header">Edit state</div>
                  <div class="card-body">
                <form action="{{ route('state-update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $state->id }}">
                    <div class="form-group">
                        <label class="form-control-label">Select Division: <span class="tx-danger">*</span></label>
                        <select class="form-control select2-show-search" data-placeholder="Select One" name="division_id">
                          <option label="Choose one"></option>
                          @foreach ($divisions as $division)
                          <option value="{{ $division->id }}" {{ $division->id == $state->division_id ? 'selected':'' }}>{{ ucwords($division->division_name) }}</option>
                          @endforeach
                        </select>
                        @error('division_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label class="form-control-label">Select District: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text"  value="{{ $state->district->district_name }}" placeholder="Enter state_name" readonly >
                      </div>

                    <div class="form-group">
                      <label class="form-control-label">state Name: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="state_name" value="{{ $state->state_name }}" placeholder="Enter state_name">
                      @error('state_name')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-layout-footer">
                      <button type="submit" class="btn btn-info">state Update</button>
                    </div><!-- form-layout-footer -->
                  </form>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>



    @endsection