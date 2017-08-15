{{-- popup notification --}}
@include('js.toastr')
{{-- ajax translate --}}
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#keyword").on("input paste", function() { // key up
        if ($('#keyword').val() == '') {
            $('#btn-clear').attr('style', 'display:none;');
        } else {
            $('#btn-clear').attr('style', 'display');
        }
        search();
    });
    $('#submit').on('click', function(){
        search();
    })
    $('#btn-clear').on('click', function(){
        $('#keyword').val('').trigger('input');
    });
    
    $('#improve-meaning').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ route('improve-meaning') }}",
            data: {
                'old_meaning_id': $('input[name=old_meaning_id]').val(),
                'new_meaning': $('#new_meaning').val(),
                'comment': $('#comment').val(),
            },
            success: function (data) {
                toa(data);
                $('#input-meanings').attr('style', 'display:none;');
            },
            error: function(data) {
                var errors = data.responseJSON;
                // errors['alert-type'] = 'error';
                // console.log(errors);
            }
        });    
    });
</script>
{{-- search function --}}
<script>
    function nl2br (str, is_xhtml) {   
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
    }

    function extendMeaning(data, id) {
        var content = '';
        for (var i = 0, len = data.length; i < len; i++) {
            content += '<li class="meaning-content">' +
            nl2br(data[i].meaning) +
            '<button class="btn btn-default btn-sm" id="btn-edit" onclick="setForm('+data[i].id+')" title="Improve this translation"><i class="fa fa-pencil"></i></button></li>'; 
        }
        $('#other-meaning').removeAttr('hidden');
        $('#other-meaning-'+id).removeAttr('hidden');
        $('#other-meaning-'+id+'-content').html('<ul>'+content+'</ul>');
    }

    function setForm(id) {
        $('#old_meaning_id').attr('value', id);
        $('#input-meanings').attr('style', 'display');
    }

    function clearContent() {
        $('#other-meaning').attr('hidden', true);
        $('#other-meaning-noun').attr('hidden', true);
        $('#other-meaning-verb').attr('hidden', true);
        $('#other-meaning-adjective').attr('hidden', true);
        $('#other-meaning-preposition').attr('hidden', true);
    }

    function search() {
        var lang = $("input[name=radio-lang]:checked").val();
        var text = $('#keyword').val();
        clearContent();
        $.ajax({
            type:"POST",
            async: true,
            url: "{{ route('processTranslate') }}", // script to validate in server side
            data: {
                'text': text,
                'lang': lang,
            },
            success: function(data) {
                if ($.isEmptyObject(data) && $('#keyword').val() != '') { 
                    $('#btn-contribute').attr('style', 'display'); 
                } else { 
                    $('#btn-contribute').attr('style', 'display:none;'); 
                }
                for (var key in data){
                    switch(key){
                        case '{{ NOUN }}':
                            extendMeaning(data[key], 'noun');
                            break;
                        case '{{ VERB }}':
                            extendMeaning(data[key], 'verb');
                            break;
                        case '{{ ADJECTIVE }}':
                            extendMeaning(data[key], 'adjective');
                            break;
                        case '{{ PREPOSITION }}':
                            extendMeaning(data[key], 'preposition');
                            break;
                    }
                };
                $('#meaning').val(data.best).change();
            },
            error: function(data){
                $('#btn-contribute').attr('style', 'display:none;');
            }
        });   
    }
</script>