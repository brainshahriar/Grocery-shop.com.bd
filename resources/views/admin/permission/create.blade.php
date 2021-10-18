@extends('layouts.admin-master')
@section('admin-content')
@section('permission') active show-sub @endsection
@section('add-permission') active @endsection

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
                <div class="card-header">Add New permission</div>
                  <div class="card-body">
                <form action="{{ route('permission.store') }}" method="POST" >
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                               <div class="form-group">
                                 <label for="role">Select Role</label>
                                 <select class="form-control" name="role_id" id="role">
                                   <option value="">Select Role</option>
                                   @foreach ($roles as $role)
                                   <option value="{{ $role->id }}">{{ $role->name }}</option>
                                   @endforeach
                                 </select>
                                 @error('role_id')
                                 <span class="text-danger">{{ $message }}</span>
                                @enderror
                               </div>

                              <div class="form-layout-footer">
                                <button type="submit" class="btn btn-info">Create</button>
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
                                        <input type="checkbox" name="permission[slider][add]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[slider][view]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[slider][edit]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[slider][delete]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[slider][list]" value="1">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Brand</td>
                                    <td>
                                        <input type="checkbox" name="permission[brand][add]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[brand][view]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[brand][edit]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[brand][delete]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[brand][list]" value="1">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Categories</td>
                                    <td>
                                        <input type="checkbox" name="permission[cat][add]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[cat][view]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[cat][edit]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[cat][delete]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[cat][list]" value="1">
                                    </td>
                                </tr>

                                <tr>
                                    <td>SubCategories</td>
                                    <td>
                                        <input type="checkbox" name="permission[subcat][add]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[subcat][view]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[subcat][edit]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[subcat][delete]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[subcat][list]" value="1">
                                    </td>
                                </tr>

                                <tr>
                                    <td>Sub SubCategories</td>
                                    <td>
                                        <input type="checkbox" name="permission[subsubcat][add]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[subsubcat][view]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[subsubcat][edit]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[subsubcat][delete]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[subsubcat][list]" value="1">
                                    </td>
                                </tr>

                                <tr>
                                    <td>Products</td>
                                    <td>
                                        <input type="checkbox" name="permission[product][add]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[product][view]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[product][edit]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[product][delete]" value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[product][list]" value="1">
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