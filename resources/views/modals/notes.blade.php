<div class="modal " id="create_notes">

  <div class="modal-dialog mt-5 modal-md">
      <div class="modal-content">
          <div class="">
              <div class="text-end pt-3 px-3">
                  <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
              </div>
              <h3 class="modal-title text-center" id="notes_modals_title">New Notes</h3>
          </div>
          <div class="modal-body">
            <form class="form-inline" action="{{route('add_notes')}}" method="POST" id="notes_form">
                @csrf
                <label for="" class="mr-sm-2">Title</label>
                <input type="text" name="title" class="form-control mb-2 mr-sm-2" id="notes_title">
                
                <textarea name="content" style="display:none" id="hiddenArea_notes"></textarea>

                <div id="editor-container">
                
                  </div>
                <label for="" class="mr-sm-2">Related to {{$page_title}}</label>
                @php
                  $name = $url.'_id';
                @endphp
                <input type="text" class="d-none" value="{{$id}}" name="{{$name}}" >
                <div class="modal-footer bg-light d-flex align-items-center justify-content-center" id="notes_modal_buttons_section">
                    <a class="btn btn-danger " id="notes_delete_button" data-dismiss="">Delete</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> --}}
                </div>

            </form>  
          </div>
      </div>
  </div>
</div>


<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>


var quill1 = new Quill('#editor-container', {
  modules: {
    toolbar: [
      ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
          ['blockquote', 'code-block'],

          [{ 'header': 1 }, { 'header': 2 }],               // custom button values
          [{ 'list': 'ordered'}, { 'list': 'bullet' }],
          [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
          [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
          [{ 'direction': 'rtl' }],                         // text direction

          [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
          [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

          [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
          [{ 'font': [] }],
          [{ 'align': [] }],

          ['clean'] 
    ]
  },
  placeholder: 'Content ...',
  theme: 'snow'  // or 'bubble'
});

quill1.on('text-change', function(delta, source) {
	updateHtmlOutput()
})
$('#btn-convert').on('click', () => { updateHtmlOutput() })

function getQuillHtml() { return quill1.root.innerHTML; }

function updateHtmlOutput()
{
	let html = getQuillHtml();
    // console.log ( html );
    document.getElementById('hiddenArea_notes').innerText = html;
}

updateHtmlOutput()


$('.notes_title_content').on('click', function(){
        let title = $(this).data('name');
        let content = $(this).parent().find('.notes_content').val();
        let action = $(this).parent().find('.notes_action').val();
        let href = $(this).parent().find('.notes_delete_hreff').val();

        console.log(href);
        $('#notes_modals_title').html('Edit Notes');
        $('#notes_title').val(title);
        // $('#notes_title').val(title);
        quill1.root.innerHTML = content;
        let html = getQuillHtml();
        document.getElementById('hiddenArea_notes').innerText = html;
        $('#notes_form').attr('action', action);
        $('#notes_delete_button').attr('href', href);

        // $('#notes_modal_buttons_section').append('<button class="btn btn-danger" data-dismiss="modal">Delete</button>')

    })


    $('.clear_notes_form').on('click', function(){
      console.log(23124);
      $('#notes_modals_title').html('New Notes');
      $('#notes_title').val("");
      quill1.root.innerHTML = "";
      let html = getQuillHtml();
      document.getElementById('hiddenArea_notes').innerText = html;
      var origin   = window.location.origin; 
      $('#notes_form').attr('action', origin+'/add_notes');
      $('.notes_delete_button').attr('href', "")
    })

</script>
