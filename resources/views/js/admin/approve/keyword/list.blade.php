<script>
    $(document).ready(function() {      
        var canClick = '';
        var dataTable = $('#dataTables-example').DataTable({
            "dom": '<"lenght"l><"toolbar">frt<"info"i>p',
            "columns" : [
                 {'data':'0'},
                 {
                    sortable: false,
                    "render": function (data, type, row, meta) {
                        if (row[1] == 0) {opCode = 'ADD';}
                        else if (row[1] == 1) {opCode = 'EDIT';}
                        else opCode = "";
                        return'<span class="drop-comment" title="'+row[5]+'">'+opCode+'</span>';
                    }
                 },
                 {'data':'2'},
                 {'data':'3'},
                 {'data':'4'},
                 {
                    sortable: false,
                    "render": function ( data, type, row, meta ) {
                        if ($('#list').val() == -1) {
                            canClick = "";
                        }else{
                            canClick = "disabled";
                        }
                        return '<form action="{{ route('approveOnKeyword') }}" method="POST" id="approve">'+
                                    '{{ csrf_field() }}'+
                                    '<input type="hidden" name="id" value='+row[0]+'>'+
                                    '<input type="hidden" name="opCode" value='+row[1]+'>'+
                                    '<button type="submit" class="btn btn-success '+canClick+'" id="btn-approve"><i class="fa fa-thumbs-o-up fa-fw"></i>Approve</button>'+
                                '</form>';
                    }
                 },
                 {
                    sortable: false,
                    "render": function ( data, type, row, meta ) {
                        return '<form action="{{ route('declineOnKeyword') }}" method="POST" id="decline">'+
                                    '{{ csrf_field() }}'+
                                    '<input type="hidden" name="id" value='+row[0]+'>'+
                                    '<input type="hidden" name="opCode" value='+row[1]+'>'+
                                    '<button id="btn-decline" class="btn btn-warning '+canClick+'"><i class="fa fa-thumbs-o-down fa-fw"></i>Decline</button>'+
                                '</form>';
                    }
                 },
                 {
                    sortable: false,
                    "render": function ( data, type, row, meta ) {
                        return '<form action="{{ route('deleteRequest') }}" method="POST" id="delete">'+
                                    '{{ csrf_field() }}'+
                                    '<input type="hidden" name="id" value='+row[0]+'>'+
                                    '<button type="submit" class="btn btn-danger '+canClick+'" id="btn-delete"><i class="fa fa-trash-o fa-fw"></i>Delete</button>'+
                                '</form>';;
                    }
                 },
            ],
        });
        $('<span id="box-text"/>').text('of ').appendTo('div.toolbar')
        $select = $('<select class="form-control" id="list"/>').appendTo('div.toolbar')
        $('<option/>').val('{{ IN_QUEUE }}').text('In Queue').appendTo($select);
        $('<option/>').val('{{ APPROVED }}').text('Approved').appendTo($select);
        $('<option/>').val('{{ DECLINED }}').text('Declined').appendTo($select);
        $('<option/>').val('{{ DELETED }}').text('Deleted').appendTo($select);
        $('<span/>').text(' request list').appendTo('div.toolbar');
        
        $.ajax({
            type: "POST",
            url: "admin/queue/keyword/change",
            data: {
              list: $('#list').val()
            },
            success: function(res) {
                //Sets your content into your div
                dataTable.clear().draw();
                var json = JSON.parse(res);
                dataTable.rows.add(json.data); // Add new data
                dataTable.columns.adjust().draw(); // Redraw the DataTable
                console.log();
            }
         });
        $('#list').on('change', function() {
            $.ajax({
                type: "POST",
                url: "admin/queue/keyword/change",
                data: {
                  list: $('#list').val()
                },
                success: function(res) {
                    //Sets your content into your div
                    dataTable.clear().draw();
                    var json = JSON.parse(res);
                    dataTable.rows.add(json.data); // Add new data
                    dataTable.columns.adjust().draw(); // Redraw the DataTable
                    if ($('#list').val() == -1) {
                        canClick = "active";
                    }else{
                        canClick = "disabled";
                    }
                    console.log(canClick);

                }
             });
        });
    });
</script>
