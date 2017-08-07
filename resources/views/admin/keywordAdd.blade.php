
@extends('layout.index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Keyword
                    <small>Add</small>
                </h1>
            </div>

            <div class="col-sm-4">
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{$err}}<br>
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('adminAddKeyword') }}" method="POST" id="add_keyword_form">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div id="add_word">
                        <label for="keyword">Keyword</label><font color="red"><small><span id="errNm0">  </span></small></font>
                        <input type="text" class="form-control keyword" name="keyword" placeholder="Example: play" data-error="#errNm0">
                        <br>
                        <label>Meaning</label><font color="red"><small><span id="errNm1"> </span></small></font>
                        <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control meaning" name="translate[1][meaning]" placeholder="VD: chơi" data-error="#errNm1">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="more_meaning" type="button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </span>
                        </div>
                        </div>
                        <label for="">Language</label>
                        <div class="form-group">
                            <label><input type="radio" name="translate[1][language]" value='0' checked /> Vietnamese<br></label>
                            <label><input type="radio" name="translate[1][language]" value='1' /> English<br></label>
                        </div>
                        <hr>
                    </div>
                    <button id="submit" type="submit" class="btn btn-success">
                        <i class="fa fa-floppy-o fa-fw" aria-hidden="true"></i>Save
                    </button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-refresh fa-fw"></i>Reset</button>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection

@section('script')
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
                $('#add_word').append(
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
                    '<label><input type="radio" name="translate['+i+'][language]" value=\'0\' checked /> Vietnamese<br></label>\n' +
                    '<label><input type="radio" name="translate['+i+'][language]" value=\'1\' /> English<br></label>\n' +
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
                    return this.optional(element) || /^([ァ-ヶーぁ-ん]+)$/.test(value);
                }, "<br/>Please enter full-width hiragana katakana."
            );

            jQuery.validator.addMethod("hiragana", function(value, element) {
                    return this.optional(element) || /^([ぁ-ん]+)$/.test(value);
                }, "<br/>Please enter full-width Hiragana."
            );

            jQuery.validator.addMethod("katakana", function(value, element) {
                    return this.optional(element) || /^([ァ-ヶー]+)$/.test(value);
                }, "<br/>Please enter full-width katakana."
            );

            jQuery.validator.addMethod("hankana", function(value, element) {
                    return this.optional(element) || /^([ｧ-ﾝﾞﾟ]+)$/.test(value);
                }, "<br/>Please enter half-width katakana."
            );

            jQuery.validator.addMethod("alphabet", function(value, element) {
                    return this.optional(element) || /^([a-zA-z\s]+)$/.test(value);
                }, "Please insert alphabet."
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
                        result = (data == false) ? true : false;
                    }
                    });
                    // return true if keyword is exist in database
                    console.log(result);
                    return result;

                },
                "This keyword is already added!"
            );

            $.validator.addClassRules({
                meaning: {
                    required: true,
                    alphabet: true
                }
            });
            $('#add_keyword_form').validate({
                rules: {
                    "keyword": {
                        required: true,
                        alphabet: true,
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
@endsection