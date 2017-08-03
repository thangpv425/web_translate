
@extends('layout.index')

@section('content')
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
                        <div class="form-group">
                            <label>Keyword</label>
                            <input class="form-control keyword" id="keyword" name="txtKeyWord" placeholder="Example: play" />
                        </div>
                        <div class="form-group">
                            <label>Translate</label>
                            <input class="form-control meaning" name="translate[1][meaning]" placeholder="Example: chơi" />
                        </div>
                        <label for="">Language</label>
                        <div class="form-group">
                            <label><input type="radio" name="translate[1][language]" value='0' checked /> Vietnamese<br></label>
                            <label><input type="radio" name="translate[1][language]" value='1' /> English<br></label>
                        </div>
                    </div>
                    <button id="submit" type="submit" class="btn btn-success">Save</button>
                    <button type="reset" class="btn btn-primary">Reset</button>
                </form>
            </div>

            <div class="col-sm-1" id="remove" >
                <div class="form-group">
                    <label style="visibility: hidden;">Action</label>
                    <button id="more_meaning" class="btn btn-success form-control">Add</button>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            var i = 1;
            $('#more_meaning').click(function(){
                i++;
                $('#add_word').append(
                    '<div id="number'+i+'">\n'+
                    '<div class="form-group">\n' +
                    '<label>Translate</label>\n' +
                    '<button style="float: right" type="button" class="btn btn-danger btn_remove" id="'+i+'"><i class="fa fa-trash"></i></button>\n' +
                    '<input class="form-control meaning" name=translate['+i+'][meaning]" placeholder="Example: chơi" />\n' +
                    '</div>\n' +
                    '<label for="">Language</label>\n' +
                    '<div class="form-group">\n' +
                    '<label><input type="radio" name="translate['+i+'][language]" value=\'0\' checked /> Vietnamese<br></label>\n' +
                    '<label><input type="radio" name="translate['+i+'][language]" value=\'1\' /> English<br></label>\n' +
                    '</div>\n' +
                    '</div>\n'
                );
            });

            $(document).on('click','.btn_remove', function(){
                var buttonId = $(this).attr('id');
                $('#number'+buttonId+'').remove();
            });

            jQuery.validator.addMethod("kana", function(value, element) {
                    return this.optional(element) || /^([ァ-ヶーぁ-ん]+)$/.test(value);
                }, "<br/>Please enter full-width hiragana katakana"
            );

            jQuery.validator.addMethod("hiragana", function(value, element) {
                    return this.optional(element) || /^([ぁ-ん]+)$/.test(value);
                }, "<br/>Please enter full-width Hiragana"
            );

            jQuery.validator.addMethod("katakana", function(value, element) {
                    return this.optional(element) || /^([ァ-ヶー]+)$/.test(value);
                }, "<br/>Please enter full-width katakana"
            );

            jQuery.validator.addMethod("hankana", function(value, element) {
                    return this.optional(element) || /^([ｧ-ﾝﾞﾟ]+)$/.test(value);
                }, "<br/>Please enter half-width katakana"
            );

            jQuery.validator.addMethod("alphabet", function(value, element) {
                    return this.optional(element) || /^([a-zA-z\s]+)$/.test(value);
                }, "<br/>Please insert alphabet"
            );

            $.validator.addClassRules({
                meaning: {
                    required: true,
                    alphabet: true
                }
            });

            $.validator.addClassRules({
                keyword: {
                    required: true,
                    alphabet: true
                }
            });

            $('#add_keyword_form').validate({
                rules: {
                    txtKeyWord:{
                        exist: {
                            type: "GET",
                            url : "./admin/checkExistKeyword",
                            data: {keyword: $("#keyword").val()},
                            dataFilter: function (data) {
                                if (data >= 1) {
                                    return "\"" + "Keyword already in use!" + "\"";
                                } else {
                                    return 'true';
                                }
                            }
                        }
                    }
                },
                messages: {
                    txtKeyWord: {
                        exist: "Keyword already in use!"
                    }
                }
            });

        });
    </script>
@endsection