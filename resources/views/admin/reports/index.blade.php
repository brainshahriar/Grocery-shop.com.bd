@extends('layouts.admin-master')
@section('admin-content')
@section('reports','active')


 
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">ASM</a>
        <span class="breadcrumb-item active">Reports</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
   
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"> Search By Date </div>
                        <div class="card-body">
                            <form action="{{ route('search-by-date') }}" method="POST" >
                                @csrf
                                <div class="form-group">
                                  <label class="form-control-label">Select Date: <span class="tx-danger">*</span></label>
                                  <input class="form-control" type="date" name="date"  >
                                  @error('date')
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                </div>
            
                                <div class="form-layout-footer">
                                  <button type="submit" class="btn btn-info">Search</button>
                                </div><!-- form-layout-footer -->
                              </form>
                        </div>
                  
                </div>
           
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"> Search By Month </div>
                        <div class="card-body">
                            <form action="{{ route('search-by-month') }}" method="POST" >
                                @csrf
                                <div class="form-group">
                                  <label class="form-control-label">Select Month: <span class="tx-danger">*</span></label>
                                  <select name="month_name" id="" class="form-control select2" data-placeholder="Choose One" data-validation="required">
                                    <option label="Choose one"></option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>

                                  </select>
                                  @error('month_name')
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                </div>
                                <div class="form-group">
                                <label class="form-control-label">Select Year: <span class="tx-danger">*</span></label>
                                <select name="year_name" id="" class="form-control select2" data-placeholder="Choose One" data-validation="required">
                                  <option label="Choose one"></option>
                                  <option value="2021">2021</option>
                                  <option value="2020">2020</option>
                                  <option value="2019">2019</option>
                                  <option value="2018">2018</option>
                                  <option value="2017">2017</option>

                                </select>
                                @error('year_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                                <div class="form-layout-footer">
                                  <button type="submit" class="btn btn-info">Search</button>
                                </div><!-- form-layout-footer -->
                              </form>
                        </div>
                  
                </div>
           
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"> Search By Year </div>
                        <div class="card-body">
                            <form action="{{ route('search-by-year') }}" method="POST" >
                                @csrf
                                <div class="form-group">
                                <label class="form-control-label">Select Year: <span class="tx-danger">*</span></label>
                                <select name="year_name" id="" class="form-control select2" data-placeholder="Choose One" data-validation="required">
                                  <option label="Choose one"></option>
                                  <option value="2021">2021</option>
                                  <option value="2020">2020</option>
                                  <option value="2019">2019</option>
                                  <option value="2018">2018</option>
                                  <option value="2017">2017</option>

                                </select>
                                @error('year_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                                <div class="form-layout-footer">
                                  <button type="submit" class="btn btn-info">Search</button>
                                </div><!-- form-layout-footer -->
                              </form>
                        </div>
                  
                </div>
           
            </div>
  
        </div>
      </div>

    </div>
@endsection
