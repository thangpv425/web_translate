@extends('layout.index')
@section('modal')
<div class="container">
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal-keyword" style="text-align: center;">Keyword here</h4>

      </div>
      <div class="modal-body">
        <div class="row meaning-content">
          <div class="col-md-6 meaning-vi">
          <label for="meaning-vi">Vietnamese</label>
          <hr>
            <div id="meaning-vi-noun">
                <label for="meaning-vi-noun"><i>Noun</i></label>
                <div id="meaning-vi-noun-content"></div>
                <hr>
            </div>
            <div id="meaning-vi-verb">
                <label for="meaning-vi-verb"><i>Verb</i></label>
                <div id="meaning-vi-verb-content"></div>
                <hr>
            </div>
            <div id="meaning-vi-adjective">
                <label for="meaning-vi-adjective"><i>Adjective</i></label>
                <div id="meaning-vi-adjective-content"></div>
                <hr>
            </div>
            <div id="meaning-vi-preposition">
                <label for="meaning-vi-preposition"><i>Preposition</i></label>
                <div id="meaning-vi-preposition-content"></div>
                <hr>
            </div>          
          </div>
          {{-- /.col-md-6 meaning-vi --}}
          <div class="col-md-6 meaning-en">
            <label for="meaning-en">English</label>
            <hr>
            <div id="meaning-en-noun">
                <label for="meaning-en-noun"><i>Noun</i></label>
                <div id="meaning-en-noun-content"></div>
                <hr>
            </div>
            <div id="meaning-en-verb">
                <label for="meaning-en-verb"><i>Verb</i></label>
                <div id="meaning-en-verb-content"></div>
                <hr>
            </div>
            <div id="meaning-en-adjective">
                <label for="meaning-en-adjective"><i>Adjective</i></label>
                <div id="meaning-en-adjective-content"></div>
                <hr>
            </div>
            <div id="meaning-en-preposition">
                <label for="meaning-en-preposition"><i>Preposition</i></label>
                <div id="meaning-en-preposition-content"></div>
                <hr>
            </div>
          </div>
          {{-- /.col-md-6 meaning-en --}}
        </div>
        {{-- /.row meaning-content --}}
      </div>
      <div class="modal-footer">
        <a class="btn btn-primary" id="add-meaning" href="" style="border: none;">Add meaning</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>
</div>
@endsection
@section('content')
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Word
              <small>List</small> 
              <a href="admin/add/keyword" class="btn btn-default" role="button">+ Add new keyword</a>
          </h1>
      </div>
      @if(session('notification'))
          <div class="alert alert-success">
              {{session('notification')}}
          </div>
      @endif
      <!-- /.col-lg-12 -->
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <thead>
              <tr class="odd gradeX" align="center">                           
                  <td><b>ID</b></b></td>
                  <td><b>Keyword</b></td>
                  <td><b>Detail</b></td>
              </tr>
          </thead>
          <tbody>
          @foreach($keywords as $key => $keyword)
              <tr class="odd gradeX" align="center">
                  <td>{{ $key }}</td>
                  <td>{{ $keyword->keyword}}</td>
                  <td class="center"><a onclick="getDataForModal(this)" data-toggle="modal" data-target="#myModal" data-keyword="{{ $keyword->keyword }}"><i class="fa fa-eye fa-fw"></i>Details</a></td>
              </tr>
          @endforeach
          </tbody>
      </table>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
@endsection
@section('script')
<script>
function extendMeaning(data, lang, tag_id) {
    var content = '';
    for (var i = 0, len = data.length; i < len; i++) {
        content += '<li class="meaning-content">' +
        nl2br(data[i].meaning) +
        '</li>'; 
    }
    $('#meaning-'+lang+'-'+tag_id).removeAttr('hidden');
    $('#meaning-'+lang+'-'+tag_id+'-content').html('<ul>'+content+'</ul>');
}

function switchMeaning(data, key, lang) {
  switch(key){
    case '{{ NOUN }}':
        extendMeaning(data[key], lang, 'noun');
        break;
    case '{{ VERB }}':
        extendMeaning(data[key], lang, 'verb');
        break;
    case '{{ ADJECTIVE }}':
        extendMeaning(data[key], lang, 'adjective');
        break;
    case '{{ PREPOSITION }}':
        extendMeaning(data[key], lang, 'preposition');
        break;
  }
}

function resetForm() {
    var lang = ['vi', 'en'];
    var type = ['noun', 'verb', 'adjective', 'preposition'];
    for (var i = lang.length - 1; i >= 0; i--) {
        for (var j = type.length - 1; j >= 0; j--) {
            $('#meaning-'+lang[i]+'-'+type[j]).attr('hidden', true);
        }
    }
}

function getDataForModal(btn) {
  var keyword = btn.getAttribute('data-keyword');
  $('#modal-keyword').html('<label><i>' + keyword + '</i></label>');
  resetForm();
  $.ajax({
    type:"POST",
    async: true,
    url: "{{ route('detail-meaning') }}", // script to excute in server side
    data: {'keyword': keyword},
    success: function(data) {
      for (var key in data){
        switch(key){
          case '{{ VIETNAMESE }}':
            for (var vi_key in data[key]){
              switchMeaning(data[key], vi_key, 'vi');
            }
            break;
          case '{{ ENGLISH }}':
            for (var en_key in data[key]){
                switchMeaning(data[key], en_key, 'en');
            }
        }
      }
    }
  });
}
</script>
    @include('js.admin.ListKeyword')
@endsection