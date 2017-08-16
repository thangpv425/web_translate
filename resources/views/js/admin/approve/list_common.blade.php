@include('js.toastr')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// draw table
function drawTable(table, url) {
    $.ajax({
        type: "POST",
        url: "admin/"+url+"-temp/list",
        data: {
          list: $('#list').val()
        },
        success: function(data) {
            //Sets your content into your div
            table.clear().draw();
            table.rows.add(data.data); // Add new data
            table.columns.adjust().draw(); // Redraw the DataTable
        }
     });
}

//  write comment before decline request
$('#dataTables-example').on('submit', '#decline', function(e) {
    e.preventDefault();
    var cmt = prompt("Please enter comment", "This word is ...");
    var id = $('input[name=id]', this).val();
    var opCode = $('input[name=opCode]', this).val();
    var url = $(this).attr('action');
    var post = $(this).attr('method');
    $.ajax({
        type : post,
        url : url,
        data : {'id' : id, 'opCode' : opCode, 'cmt' : cmt},
        success:function(data){
            toa(data);
            $('#list').trigger('change');
        }
    });
});
</script>