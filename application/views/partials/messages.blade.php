@section('messages')
  <div class="panel sidepanel">
    <h4><span class="foundicon-mail"></span>&nbsp;&nbsp;Messages</h4>
    <!--<p>Welcome back, {{ Auth::user()->fullname }}</p>-->
    <div class="message-list-side">

      @foreach($messages as $message)
        <div class="message-list-item">
          <span class="category-info">Internal</span><br/>
          <span class="author-info">from : </span><br />{{$message['from']}}<br/>
          <span class="author-info">date : </span>{{date('d-m-Y h:i:s',$message['createdDate']->sec)}}<br/>
          <span class="author-info">subject : </span>{{$message['subject']}}<br/>
          <p>
            {{limitwords($message['body'],50)}}
          </p>
          <span class="content-info"><span class="messageview" id="{{ $message['_id'] }}">read more</span></span>
        </div>
      @endforeach
    </div>
  </div>

<script type="text/javascript">
    $(document).ready(function(){
      $('.sidepanel').click(function(e){

        if ($(e.target).is('.messageview')) {
          var doc_id = e.target.id;
          var src = '{{ URL::to('message/view/')}}' + doc_id;

          $.fancybox({
            type:'iframe',
            href: '{{ URL::to("message/view/") }}' + doc_id,
            autosize: true
          });
        }

      });

    });
</script>


@endsection