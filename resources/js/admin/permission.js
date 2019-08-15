$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#permissions').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#permissions').attr('data-url'),
        columns: [
            { data: 'id', name: 'id' },
            { data: 'display_name', name: 'display_name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
        ],
    });
});