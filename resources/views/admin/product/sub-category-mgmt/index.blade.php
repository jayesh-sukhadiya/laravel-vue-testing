@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('public/assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/assets/bundles/pretty-checkbox/pretty-checkbox.min.css') }}">
@endsection
@section('content') 
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sub Category</h4>
                            <div class="row right-15">
                                <div class="col-12"> <a data-toggle="modal" data-href="#add-update-sub-category" href="#add-update-sub-category" class="btn btn-primary add-sub-category" title="Add New Sub Category!"><i class="fas fa-plus mr-2"></i>Add Sub Category</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="save-stage" data-page-length='10' style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Category Name</th>
                                            <th>Sub Category</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>@if(count($datarecords) > 0)
                                        <?php $i=0 ; ?>@foreach($datarecords as $data) <?php $i++; ?>
                                        <tr id="<?php echo $data->cat_id; ?>">
                                            <td class="text-center" width="5%">{{ $i }}</td>
                                            <td>{{ $data->cat_name }}</td>
                                            <td>{{ $data->sub_cat_name }}</td>
                                            <td>
                                                <div class="material-switch" style="margin-left: -15px;">
                                                    <input id="switch-primary-{{$data->cat_id}}" value="{{$data->cat_id}}" class="status" name="toggle" type="checkbox" {{ $data->cat_status === 0 ? 'checked' : '' }}>
                                                    <label for="switch-primary-{{$data->cat_id}}" class="btn-success"></label>
                                                </div>
                                            </td>
                                            <td class="text-center" width="15%">
                                                <!--------- Begin Edit Link --------->
                                                <a data-toggle="modal" data-href="#add-update-sub-category" href="#add-update-sub-category" class="btn btn-icon btn-primary mr-1 update-sub-category" data-id="{{  CryptoCode::encrypt($data->cat_id) }}" data-category-id="{{ $data->sub_cat_id }}" data-category-name="{{ $data->cat_name }}" data-sub-category-name="{{ $data->sub_cat_name }}" title="Edit Record!"><i class="far fa-edit"></i>
                                                </a>
                                                <!--------- End Edit Link --------->
                                                <!--------- Begin Delete Link --------->
                                                <button class="btn btn-icon btn-danger" onclick="deleteRecord(<?php echo $data->cat_id;?>)"><i class="fas fa-trash-alt"></i>
                                                </button>
                                                <!--------- End Delete Link --------->
                                            </td>
                                        </tr>
                                        @endforeach 
                                        @else
                                        <td colspan="6" style="text-align: center;">Record not available!</td>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Begin add / update category model -->
    <div class="modal fade" id="add-update-sub-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="width: 600px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel"><span id="model-title">Sub Category</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <form class="form-horizontal" role="form" method="POST" action="{{ url('store-update-sub-category') }}">
                        @csrf
                        <input type="hidden" value="add-update-sub-category" name="model_name" />
                        <input type="hidden" name="category_id" id="category_id" />
                        <div class="form-group">
                            <label for="sub_cat_id">Select Category<span class="required-star">*</span></label>
                            <select name="sub_cat_id" class="form-control" id="category-id">
                                @foreach($categorys as $category)
                                <option value="{{ CryptoCode::encrypt($category->cat_id) }}" >{{ $category->cat_name }}</option>
                                @endforeach
                            </select>
                            @error('sub_cat_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sub_cat_name">Category Name<span class="required-star">*</span></label>
                            <input type="text" name="sub_cat_name" class="form-control" id="category_name" value="{{ old('sub_cat_name') }}" placeholder="Enter Category Name" required maxlength="150">
                            @error('sub_cat_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-pencil-square-o"></i> <span id="button-submit">Save</span></button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle-o"></i> Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End add / update category model -->
@endsection
@section('script')
<script src="{{ asset('public/assets/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('public/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/assets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Page Specific JS File -->
<script src="{{ asset('public/assets/js/page/datatables.js') }}"></script>
<script type="text/javascript">
// Any change event occuring on any input.staus (checkbox)...
$('.status').on('change', function(e) {
// A boolean that reflects the checkbox "check status"
let checked = $(this).is(':checked');
// A simple confirm...
let changed = confirm("Are you sure you want to change this status?");
//... if user cancels...
if (!changed) {
return checked ? $(this).prop('checked', false) : $(this).prop('checked', true);
}else{
var mode= $(this).prop('checked');
    var id= $(this).val();
    $.ajax({
      type:"POST",
      dataType:"JSON",
      url:"{{ url('/status-category') }}",
      data : {
        _token: '{{ csrf_token() }}',
        mode : mode,
        cat_id:id
        },
    success:function(data){
    if(data.status == "true")
    {
        iziToast.success({
            title: 'Success!',
            message: 'Category is active successfully.',
            position: 'topRight',
            timeout: 6000,
            pauseOnHover: true,
        });
    }
    else if(data.status == "false")
    {
        iziToast.success({
            title: 'Success!',
            message: 'Category is inactive successfully.',
            position: 'topRight',
            timeout: 6000,
            pauseOnHover: true,
        });
    }
    }
    });
}
});
</script>
<script type="text/javascript">
    $(document).on("click", ".update-sub-category", function () {
        var subCategoryId = $(this).data('id');
        var subCategoryName = $(this).data('sub-category-name');
        var categoryName = $(this).data('category-name');
        var categoryId = $(this).data('category-id');
        $("#category_id").val(subCategoryId);
        $("#category_name").val(categoryName);
        $("#category-id").val(categoryId);
        $("#model-title").html("Update Sub Category");
        $("#button-submit").html("Update");
        $("#category-id").prepend("<option value='" +categoryId+"'>"+categoryName+"</option>");
    });

    $(document).on("click", ".add-sub-category", function () {
        $("#category_id").val('');
        $("#category_name").val('');
        $("#model-title").html("Add Sub Category");
        $("#button-submit").html("Submit");
    });
</script>
<script type="text/javascript">
    function deleteRecord(id)
    {
      if(confirm('Are you sure you want to delete this?'))
      {
        // ajax delete data from database
          $.ajax({
            url:"{{ url('/delete-category') }}",
            type: "POST",
            data : {
            _token: '{{ csrf_token() }}',
            cat_id:id
            },
            success: function(data)
            {
                $("tr[id="+id+"]").remove();
                iziToast.success({
                    title: 'Success!',
                    message: 'Category is deleted!',
                    position: 'topRight',
                    timeout: 6000,
                    pauseOnHover: true,
                });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
      }
    }
</script>
@endsection