$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editEditor' );
    $('#theory-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#theory-table').attr('data-url'),
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
        ],
    });

    $('.submit-add').on('click', function(e){
        e.preventDefault();
        var formdata = new FormData();
        formdata.append('title', $('#add-title').val());
        formdata.append('content', CKEDITOR.instances.editor1.getData());
        formdata.append('subject_id', $('#Course').val());
        $.ajax({
            dataType: 'JSON',
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            data: formdata,
            url: route('addDocument'),
            success: function(response){
                $('#theory-table').DataTable().ajax.reload(null, false);
                $('#addNew').modal('hide');
                $('#addData')[0].reset();
                CKEDITOR.instances.editor1.setData('');
                toastr.success(response.success);
            },
            error:function(jqXHR, textStatus, errorThrown){
                if (jqXHR.responseJSON.errors.title !== undefined){
                    toastr.error(jqXHR.responseJSON.errors.title[0]);
                }
                if (jqXHR.responseJSON.errors.content !== undefined){
                    toastr.error(jqXHR.responseJSON.errors.content[0]);
                }
            }
        })
    });

    $(document).on('click', '.showdata', function(e){ 
        $('#edit').modal(show);
        var id = $(this).data('id');
        $('#edit').attr('data-id',id);
        e.preventDefault();
        $.ajax({
            dataType: 'JSON',
            method: 'get',
            cache: false,
            contentType: false,
            processData: false,
            url: route('editDocument', id),
            success: function(response){
                $('#edit-Course').val(response.subject_id);
                $('#edit-title').val(response.title);
                CKEDITOR.instances.editEditor.setData(response.content);
            },
            error:function(jqXHR, textStatus, errorThrown){
            }
        })
    });

    $('.submit-edit').on('click', function(e){
        e.preventDefault();
        var id = $('#edit').data('id');
        var formdata = new FormData();
        formdata.append('title', $('#edit-title').val());
        formdata.append('content', CKEDITOR.instances.editEditor.getData());
        formdata.append('subject_id', $('#edit-Course').val());
        $.ajax({
            dataType: 'JSON',
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            data: formdata,
            url: route('updateDocument', id),
            success: function(response){
                $('#theory-table').DataTable().ajax.reload(null, false);
                $('#edit').modal('hide');
                toastr.success(response.success);
            },
            error:function(jqXHR, textStatus, errorThrown){
                
            }
        })
    });

    $(document).on('click', '.detail', function(e){ 
        $('#show').modal(show);
        var id = $(this).data('id');
        e.preventDefault();
        $.ajax({
            dataType: 'JSON',
            method: 'get',
            cache: false,
            contentType: false,
            processData: false,
            url: route('showDocument', id),
            success: function(response){
                console.log(response.content);
                $('#show-Course').val(response.subject_id);
                $('#show-title').text(response.title);
                $('#show-content').html(response.content);
            },
            error:function(jqXHR, textStatus, errorThrown){
            }
        })
    });

    $(document).on('click', '.delete', function(e){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                var id = $(this).data('id');
                $.ajax({
                    dataType: 'JSON',
                    method: 'post',
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: route('deleteDocument', id),
                    success: function(response){
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                        $('#theory-table').DataTable().ajax.reload(null, false);
                    },
                    error:function(jqXHR, textStatus, errorThrown){
                    }
                })
                
            }
        })
    })

});
