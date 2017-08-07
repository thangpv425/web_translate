<script>
$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#decline').on('submit', function(e){
        e.preventDefault();
        var cmt = prompt("Please enter comment", "This word is ...");
        var id = $('input[name=id]').val();
        var opCode = $('input[name=opCode]').val();
        var url = $(this).attr('action');
        var post = $(this).attr('method');
        $.ajax({
            type : post,
            url : url,
            data : {'id' : id, 'opCode' : opCode, 'cmt' : cmt},
            success:function(data){
                console.log(data)
            }
        });
        location.reload();
    });
});
</script>