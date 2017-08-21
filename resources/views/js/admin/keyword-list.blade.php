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
  var keyword_id = btn.getAttribute('data-id');
  $('#modal-keyword').html('<label><i>' + keyword + '</i></label>');
  $('#add-meaning').attr('href', 'admin/editKeyword/addNewMeaning/' + keyword_id);
  $('#edit-meaning').attr('href', 'admin/editKeyword/' + keyword_id);
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