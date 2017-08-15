@extends('layout.index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="css/translate.css">
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Translate
                    <small>Japanese</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="langs">
                <div class="lang-left">
                    <div class="btn-group-left" data-toggle="buttons">
                        <label class="btn btn-default btn-sm active">
                            <input type="radio" name="radio-lang-left" id="lang1" autocomplete="off" value='jp' checked> <div class="btn-name">Japanese</div>
                        </label>
                    </div>
                    <div class="tool">
                        <a class="btn btn-default btn-sm" id="btn-contribute" title="Contribute translations" href="/user/keyword/add" style="display: none;"><i class="fa fa-plus"></i></a>
                        <div class="btn btn-default btn-sm" id="btn-clear" title="Clear text" style="display: none;"><i class="fa fa-times"></i></div>
                    </div>
                </div>
                <div class="lang-right">
                {{-- <form action="{{ route('translate') }}" method="POST"> --}}
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default btn-sm active">
                            <input type="radio" name="radio-lang" id="lang1" autocomplete="off" value='{{ VIETNAMESE }}' checked=""> <div class="btn-name">Vietnamese</div>
                        </label>
                        <label class="btn btn-default btn-sm">
                            <input type="radio" name="radio-lang" id="lang2" autocomplete="off" value='{{ ENGLISH }}'> English
                        </label>
                    </div>
                    <div class="btn btn-primary btn-sm" id="submit" type="submit">Translate</div>
                </div>
            {{-- /.langs --}}
            </div>
            <div class="rt-main">
                <div class="rt-keyword">
                    <textarea name="text" id="keyword" cols="" rows="4"></textarea>
                {{-- </form> --}}
                </div>
                <div class="rt-meaning">
                    <textarea name="text" id="meaning" rows="4" readonly></textarea>
                </div>
            </div>
            <div class="under-input">
                <div id="input-meanings" style="display: none;">
                    <form action="{{ route('improve-meaning') }}" method="post" id="improve-meaning">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="hidden" name="old_meaning_id" id="old_meaning_id">
                        <div class="form-group">
                            <label for="meaning">New meaning</label>
                            <textarea class="form-control" name="meaning" id="new_meaning" placeholder="Input new meaning here..." required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea class="form-control" name="comment" id="comment" placeholder="Comment reason here..."></textarea>
                         </div>
                        <button class="btn btn-primary btn-sm" id="submit">Submit</button>
                    </form>
                </div>
                <div id="other-meaning" hidden>
                    <label for="other-meaning"><i>Details</i></label><br>
                    <div id="other-meaning-noun">
                        <label for="other-meaning-noun"><i>Noun</i></label>
                        <div id="other-meaning-noun-content"></div>
                        <hr>
                    </div>
                    <div id="other-meaning-verb">
                        <label for="other-meaning-verb"><i>Verb</i></label>
                        <div id="other-meaning-verb-content"></div>
                        <hr>
                    </div>
                    <div id="other-meaning-adjective">
                        <label for="other-meaning-adjective"><i>Adjective</i></label>
                        <div id="other-meaning-adjective-content"></div>
                        <hr>
                    </div>
                    <div id="other-meaning-preposition">
                        <label for="other-meaning-preposition"><i>Preposition</i></label>
                        <div id="other-meaning-preposition-content"></div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    <!-- /.row -->
    </div>
<!-- /.container-fluid -->
</div>
@endsection
@section('script')
@include('js.translate.index')
@endsection