<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var i = 1;
        $('#more_meaning').click(function(){
            i++;
            $('#edit_word').append(
                '<div id="number'+i+'">\n'+
                '<div class="form-group">\n' +
                '<label>Meaning</label><font color="red"><small><span id="errNm'+i+'"> </span></small></font>' +
                '<div class="input-group">' +
                '<input type="text" class="form-control meaning" name="translate['+i+'][meaning]" placeholder="Input meaning here..." data-error="#errNm'+i+'">' +
                '<span class="input-group-btn">'+
                '<button class="btn btn-default btn_remove" id="'+i+'">'+
                '<i class="fa fa-times"></i>'+
                '</button>'+
                '</span>'   +
                '</div>\n' +
                '<label for="">Language</label>\n' +
                '<div class="form-group">\n' +
                '<label><input type="radio" name="translate['+i+'][language]" value="0" checked /> Vietnamese<br></label>\n' +
                '<label><input type="radio" name="translate['+i+'][language]" value="1" /> English<br></label>\n' +
                '</div>\n' +
                '</div>\n' +
                '<hr />'
            );
        });

        $(document).on('click','.btn_remove', function(){
            var buttonId = $(this).attr('id');
            $('#number'+buttonId+'').remove();
        });

        jQuery.validator.addMethod("kana", function(value, element) {
                return this.optional(element) || /^([a-zA-zぁ-ゔゞァ-・ヽヾ゛゜ー一-龯\u3000-\u303F]+)$/.test(value);
            }, "<br/>Please enter full-width hiragana katakana."
        );

        jQuery.validator.addMethod("vietnamese", function(value, element) {
                return this.optional(element) || /^[a-z A-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựýỳỵỷỹ]+$/.test(value);
            }, "Please insert Vietnamese or English."
        );


        $.validator.addMethod("uniqueKeyword", 
        function(value, element) {
            var result = false;
            $.ajax({
                type:"POST",
                async: false,
                url: "check/unique/keyword", // script to validate in server side
                data: {'keyword': value},
                success: function(data) {
                    result = data.isExist;
                }
                });
                // return true if keyword is exist in database
                return !result;

            },
            "This keyword is existed!"
        );

        $.validator.addClassRules({
            meaning: {
                required: true,
                vietnamese: true
            }
        });
        $('#edit_keyword_form').validate({
            rules: {
                "keyword": {
                    required: true,
                    kana: true,
                    uniqueKeyword: true
                },
            },
            messages: {},
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
    });
</script>