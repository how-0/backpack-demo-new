@if ($crud->hasAccess('update')) {{-- Or a custom permission --}}
  <a href="{{ route('article.send_mail', ['id' => $entry->getKey()]) }}" 
     class="btn btn-sm btn-link" 
     data-toggle="tooltip" 
     title="Send mail to creator">
    <i class="la la-envelope"></i> Send Mail
  </a>
@endif

<script>
    function sendMailNotification(button) {
        var id = $(button).attr('data-id');
        var url = "{{ url(config('backpack.base.route_prefix') . '/ticket') }}/" + id + "/send-mail";

        if (confirm("Send notification to the creator?")) {
            $.ajax({
                url: url,
                type: 'POST',
                data: { _token: "{{ csrf_token() }}" },
                success: function(result) {
                    new Noty({ type: "success", text: result.message }).show();
                },
                error: function(result) {
                    new Noty({ type: "error", text: "Error sending mail." }).show();
                }
            });
        }
    }
</script>