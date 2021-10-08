@extends('layouts.admin-master')
@section('coupon','active')


 
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">WinBird</a>
        <span class="breadcrumb-item active">Coupon</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">

            <div class="col-md-6 m-auto">
                <div class="card">
                    <div class="card-header"> Edit Coupon </div>
                        <div class="card-body">
                            <form action="{{ route('coupon-update') }}" method="POST" >
                                @csrf
                                <input type="hidden" name="id" value="{{ $coupons->id }}">
                                <div class="form-group">
                                  <label class="form-control-label">Coupon Name: <span class="tx-danger">*</span></label>
                                  <input class="form-control" type="text" name="coupon_name" value="{{ $coupons->coupon_name }}" placeholder="Enter Coipon Name">
                                  @error('coupon_name')
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                </div>
            
                                <div class="form-group">
                                  <label class="form-control-label">Discount (%): <span class="tx-danger">*</span></label>
                                  <input class="form-control" type="text" name="coupon_discount" value="{{ $coupons->coupon_discount }}" placeholder="Enter Discount" min="1" max="99">
                                  @error('coupon_discount')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Validity: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="date" name="coupon_validity" value="{{ $coupons->coupon_validity }}" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                    @error('coupon_validity')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                  </div>
            
                                <div class="form-layout-footer">
                                  <button type="submit" class="btn btn-info">Update</button>
                                </div><!-- form-layout-footer -->
                              </form>
                        </div>
                  
                </div>
           
            </div>
        </div>
      </div>

    </div>

