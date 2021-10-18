@extends('layouts.admin-master')
@section('admin-content')
@section('permission') active show-sub @endsection
@section('all-permission') active @endsection

     <!-- ########## START: MAIN PANEL ########## -->
     <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">SHopMama</a>
          <span class="breadcrumb-item active">Dashboard</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">Update permission</div>
                  <div class="card-body">
                <form action="{{ route('permission.update',$permission->id) }}" method="POST" >
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-4">
                               <div class="form-group">
                                 <label for="role">Select Role</label>
                                 <select class="form-control" name="role_id" id="role">
                                   <option value="">Select Role</option>
                                   @foreach ($roles as $role)
                                   <option value="{{ $role->id }}" {{ ($permission->role_id == $role->id) ? 'selected':'' }}>{{ $role->name }}</option>
                                   @endforeach
                                 </select>
                                 @error('role_id')
                                 <span class="text-danger">{{ $message }}</span>
                                @enderror
                               </div>

                              <div class="form-layout-footer">
                                <button type="submit" class="btn btn-info">Update</button>
                              </div><!-- form-layout-footer -->
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered table-responsive table-danger">
                                <thead>

                                <tr>
                                    <th>Permission</th>
                                    <th>Add</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th>List</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Sliders</td>
                                    <td>
                                        <input type="checkbox" name="permission[slider][add]"
                                        @isset($permission['permission']['slider']['add']) checked @endisset
                                         value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[slider][view]"
                                        @isset($permission['permission']['slider']['view']) checked @endisset
                                        value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[slider][edit]"
                                        @isset($permission['permission']['slider']['edit']) checked @endisset
                                         value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[slider][delete]"
                                        @isset($permission['permission']['slider']['delete']) checked @endisset
                                         value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[slider][list]"
                                        @isset($permission['permission']['slider']['list']) checked @endisset
                                         value="1">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Brand</td>
                                    <td>
                                        <input type="checkbox" name="permission[brand][add]"
                                        @isset($permission['permission']['brand']['add']) checked @endisset
                                        value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[brand][view]"
                                        @isset($permission['permission']['brand']['view']) checked @endisset
                                        value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[brand][edit]"
                                        @isset($permission['permission']['brand']['edit']) checked @endisset
                                         value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[brand][delete]"
                                        @isset($permission['permission']['brand']['delete']) checked @endisset
                                        value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[brand][list]"
                                        @isset($permission['permission']['brand']['list']) checked @endisset
                                        value="1">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Categories</td>
                                    <td>
                                        <input type="checkbox" name="permission[cat][add]"
                                        @isset($permission['permission']['cat']['add']) checked @endisset value="1">

                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[cat][view]"
                                        @isset($permission['permission']['cat']['view']) checked @endisset value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[cat][edit]"
                                        @isset($permission['permission']['cat']['edit']) checked @endisset
                                         value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[cat][delete]"
                                        @isset($permission['permission']['cat']['delete']) checked @endisset
                                        value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[cat][list]"
                                        @isset($permission['permission']['cat']['list']) checked @endisset value="1">
                                    </td>
                                </tr>

                                <tr>
                                    <td>SubCategories</td>
                                    <td>
                                        <input type="checkbox" name="permission[subcat][add]"
                                        @isset($permission['permission']['subcat']['add']) checked @endisset
                                        value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[subcat][view]"
                                        @isset($permission['permission']['subcat']['view']) checked @endisset value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[subcat][edit]"
                                        @isset($permission['permission']['subcat']['edit']) checked @endisset
                                         value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[subcat][delete]"
                                        @isset($permission['permission']['subcat']['delete']) checked @endisset
                                        value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[subcat][list]"
                                        @isset($permission['permission']['subcat']['list']) checked @endisset
                                         value="1">
                                    </td>
                                </tr>

                                <tr>
                                    <td>Sub SubCategories</td>
                                    <td>
                                        <input type="checkbox" name="permission[subsubcat][add]"
                                        @isset($permission['permission']['subsubcat']['add']) checked @endisset
                                        value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[subsubcat][view]"
                                        @isset($permission['permission']['subsubcat']['view']) checked @endisset
                                         value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[subsubcat][edit]"
                                        @isset($permission['permission']['subsubcat']['edit']) checked @endisset value="1">

                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[subsubcat][delete]"
                                        @isset($permission['permission']['subsubcat']['delete']) checked @endisset
                                        value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[subsubcat][list]"
                                        @isset($permission['permission']['subsubcat']['list']) checked @endisset
                                         value="1">
                                    </td>
                                </tr>

                                <tr>
                                    <td>Products</td>
                                    <td>
                                        <input type="checkbox" name="permission[product][add]"
                                        @isset($permission['permission']['product']['add']) checked @endisset
                                        value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[product][view]"
                                        @isset($permission['permission']['product']['view']) checked @endisset
                                        value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[product][edit]"
                                        @isset($permission['permission']['product']['edit']) checked @endisset
                                         value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[product][delete]"
                                        @isset($permission['permission']['product']['delete']) checked @endisset
                                        value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[product][list]"
                                        @isset($permission['permission']['product']['list']) checked @endisset
                                         value="1">
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                  </form>
                  </div>
              </div>
            </div>
          </div>
        </div>


    </div>
@endsection