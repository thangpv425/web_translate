<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
/**
 * convert /n newline to <br>
 * @param  {[type]}  str      [description]
 * @param  {Boolean} is_xhtml [description]
 * @return {[type]}           [description]
 */
function nl2br (str, is_xhtml) {   
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}

/**
 * popup notification when redirect
 * @type {[type]}
 */
@if(Session::has('message'))
var type = "{{ Session::get('alert-type', 'info') }}";
switch(type){
    case 'info':
        toastr.info("{!! Session::get('message') !!}", "Did You Know?");
    break;

    case 'warning':
        toastr.warning("{!! Session::get('message') !!}", "Be Careful!");
    break;

    case 'success':
        toastr["success"]("{!! session('message') !!}", "Congratulations!");
    break;

    case 'error':
        toastr.error("{!! Session::get('message') !!}", "Oops!");
    break;
}
@endif
</script>