@layout('public')

@section('content')
<div class="row">

  <div class="span4">

    <img src="{{ URL::base().'/storage/products/'.$product['_id'].'/lar_pic0'.$product['defaultpic'].'.jpg' }}" alt="{{ $product['name']}}" id="mainimageproduct" class="mixmatch" data-zoom-image="{{ URL::base().'/storage/products/'.$product['_id'].'/lar_pic0'.$product['defaultpic'].'.jpg' }}" />

    <br/>
    <img src="{{ URL::base() }}/images/roll-on.png"><span class="titlesectionnormal">ROLL ON TO ZOOM IN</span>
<?php
    /*
    <a href="#">
    </a>
    <a style="margin-left:30px;" href="#"><img src="{{ URL::base() }}/images/zoom.png"><span class="titlesectionnormal">VIEW LARGER</span>
    </a>
    */
?>

    <br/>
    <br/>
    <p>

      <div class="addimages" id="gal1">
        @for($i = 1;$i < 6;$i++)
            @if($product['homepic'] != $i && $product['defaultpic'] != $i)
                @if(file_exists(realpath('public/storage/products/'.$product['_id']).'/sm_pic0'.$i.'.jpg'))
                <a href="#"  data-image="{{ URL::base().'/storage/products/'.$product['_id'].'/sm_pic0'.$i.'.jpg' }}" data-zoom-image="{{ URL::base().'/storage/products/'.$product['_id'].'/lar_pic0'.$i.'.jpg' }}" id="{{ '0'.$i}}">
                  <img src="{{ URL::base().'/storage/products/'.$product['_id'].'/sm_pic0'.$i.'.jpg' }}" alt="{{ $product['name']}}" class="mixmatch addimage" id="{{ '0'.$i}}"/>
                </a>
                @endif
            @endif
        @endfor
  </div>
</p>
</div>
<div class="span8 clearfix">
    <div class="detailproduct">
      <h2 class="product-title">{{$product['name']}}</h2>

        <iframe src="//www.facebook.com/plugins/like.php?href={{ urlencode( URL::full() ) }}&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=true&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>
        <br />
        <a href="https://twitter.com/share" class="twitter-share-button" data-via="peachtoblack" data-hashtags="peachtoblack">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

    <?php
    /*
      <a href="#" class="fblike"><img src="{{ URL::base() }}/images/fblike.gif"/></a>
      <a href="#" class="loves"><img src="{{ URL::base() }}/images/loves4.gif"/><br/><span>based on 196loves</span></a>

    */
    ?>
    <div class="availablecont">
        <p>Available in:</p>
        @foreach($colors as $ac)
        <div class="coloravailableselect" style="background-color:{{$ac}}; border:thin solid #ccc"></div>
        @endforeach
    </div>
    <p>Price: {{ $product['priceCurrency'].' '.number_format($product['retailPrice'],2,',','.')}}</p>
    <h3>ABOUT THIS PRODUCT</h3>
    {{$product['bodycopy']}}
    </div>


    <div class="optionselectproduct detailproduct clearfix row-fluid">
      <div class="span2">
        <span class="titleselectbox">SELECT SIZE</span><br/>
        <select name="size" class="span12" >
          <option value="-" selected="selected">-</option>
          @foreach($sizes as $size)
          <option value="{{$size}}">{{$size}}</option>
          @endforeach
      </select>
    </div>

    <div class="span5">
        <span class="titleselectbox">SELECT COLOR</span><br/>
        <select name="color" disable="disable" >
        </select>
    </div>

    {{ Form::hidden('pid',$product['_id'],array('id'=>'product_id'))}}
    <script type="text/javascript">
    $(document).ready(function(){

        <?php

        $acart = '';
        if(Auth::guest()){
            $acart = '';
        }else{
            if(isset(Auth::shopper()->activeCart)){
              $acart = Auth::shopper()->activeCart;
          }else{
              $acart = '';
          }
      }

      ?>

      var cart_id = '{{ $acart }}';

      var product_id = '{{ $product['_id']}}';

      $('select[name="size"]').on('change',function(){
          $.post('{{ URL::to('shop/color')}}',{ size: this.value, _id:product_id },function(data){
              $('select[name="color"]').html(data.html)
              .simplecolorpicker('destroy')
              .simplecolorpicker();

              $.post('{{ URL::to('shop/qty')}}',{ color: data.defsel, size: $('select[name="size"]').val(), _id:product_id },function(data){
                  $('select[name="qty"]').html(data.html);
              },'json');

          },'json');
      });

      $('select[name="color"]').simplecolorpicker().on('change',function(){
        $.post('{{ URL::to('shop/qty')}}',{ color: $(this).val(), size: $('select[name="size"]').val(), _id:product_id },function(data){
            $('select[name="qty"]').html(data.html);
        },'json');
    });


      @if(Auth::shoppercheck() == false)

      $('#addtocart').click(function(){
          $('#signInModal').modal();
      })

      $('#signInNow').on('click',function(){
        var color = $('select[name="color"]').val();
        var size = $('select[name="size"]').val();
        var qty = $('select[name="qty"]').val();
        var username = $('#signInUsername').val();
        var password = $('#signInPassword').val();

        $.post('{{ URL::to('shop/signin')}}',{ username: username, password: password, color: color, size: size, qty: qty, _id:product_id, cart_id: '' },
          function(data){
            console.log(data);
            if(data.result == 'NOTSIGNEDIN'){
              alert(data.message);
              $('#signInModal').modal('close');
          }

          if(data.result == 'OK:ITEMADDED'){
              if(data.cartcount == 0){
                $('#shopping-badge').html('');
            }else{
                $('#shopping-badge').html(data.cartcount);
            }
            alert(data.message);
            $('#signInModal').modal('close');
        }

    },'json');

    });

      @else

      $('#addtocart').click(function(){
        var color = $('select[name="color"]').val();
        var size = $('select[name="size"]').val();
        var qty = $('select[name="qty"]').val();

        console.log(color);
        console.log(size);
        console.log(qty);



        if(color != '' && size != '-' && qty >= 0){

            $.post('{{ URL::to('shop/addtocart')}}',{ color: color, size: size, qty: qty, _id:product_id, cart_id: cart_id },function(data){
                console.log(data);
                if(data.result == 'NOTSIGNEDIN'){
                  alert(data.message);
              }

              if(data.result == 'PRODUCTADDED'){
                  var remaining = data.data.remaining;
                  var qtyopt = '';

                  for(i = 1; i <= remaining; i++){
                    qtyopt += '<option value="' + i + '" >' + i + '</option>';
                }

                console.log(qtyopt);

                $('select[name="qty"]').html(qtyopt);

                if(data.cartcount == 0){
                    $('#shopping-badge').html('');
                }else{
                    $('#shopping-badge').html(data.cartcount);
                }

                alert(data.message);

            }


        },'json');



        }else{
          alert('Please specify size, color and quantity');
      }

    })

    @endif

    });
    </script>

    <div class="span3">
        <span class="titleselectbox">SELECT QUANTITY</span><br/>
        <select class="span12" name="qty">
          <option value="-" selected="selected">-</option>
      </select>
    </div>

    <div class="span2">
        <span class="titleselectbox" style="cursor:pointer" >ADD TO CART<br/>
         <img src="{{ URL::base() }}/images/trolly.png" id="addtocart" />
     </span>

     <!-- Button to trigger modal -->

    </div>
</div>

    <?php
        /*
          <div class="clear"></div>

          <div class="detailproduct statcomment">
            <span>5 comments</span>
            <a href="#"><img src="{{ URL::base() }}/images/fbstat.gif"></a>
            <a href="#"><img src="{{ URL::base() }}/images/twittstat.gif"></a>
            <a href="#"><img src="{{ URL::base() }}/images/googlestat.gif"></a>
          </div>

            <div class="clear"></div>


        */
    ?>

</div>

    <div class="clear"></div>

        @if($product['groupParent'] == true && is_array($product['componentProducts']) && count($product['componentProducts']) > 0)
            <h3 class="recommendation">COMPOSITION</h3>
            <div class="row productlist">

            @foreach($product['componentProducts'] as $r)

                @if(file_exists(realpath('public/storage/products/'.$r['_id']->__toString()).'/sm_pic0'.$r['defaultpic'].'.jpg'))
                    <div class="productpanel">
                        <a href="{{ URL::to('/shop/detail/'.$r['_id']->__toString()) }}"><img src="{{ URL::base().'/storage/products/'.$r['_id'].'/med_pic0'.$r['defaultpic'].'.jpg' }}"></a>
                        <h3>{{$r['name']}}</h3>
                        <p>{{$r['priceCurrency']}} {{idr($r['retailPrice'])}}</p>
                    </div>
                @endif

            @endforeach

            </div>

        @endif


    @if(is_array($product['relatedProducts']) && count($product['relatedProducts']) > 0)
        <h3 class="recommendation">WE ALSO RECOMMEND</h3>

        <div class="row productlist">

            @foreach($product['relatedProducts'] as $r)

            @if(file_exists(realpath('public/storage/products/'.$r['_id']->__toString()).'/sm_pic0'.$r['defaultpic'].'.jpg'))
            <div class="productpanel">
                <a href="{{ URL::to('/shop/detail/'.$r['_id']->__toString()) }}"><img src="{{ URL::base().'/storage/products/'.$r['_id'].'/med_pic0'.$r['defaultpic'].'.jpg' }}"></a>
                <h3>{{$r['name']}}</h3>
                <p>{{$r['priceCurrency']}} {{idr($r['retailPrice'])}}</p>
            </div>
            @endif

          @endforeach

        </div>
    @endif

<div class="clear"></div>

<?php
/*
<div class="commentlist span12">
    <h4 class="commentlisttitle">what other costumers saying about this product:</h4>
    <table>
      <tr class="span12">
        <td class="comment userinfo span3">
          <p class="name titlesection"> Maya Hasan</p>
          <p>DKI JAKARTA</p>
          <p>(23 Reviews)</p>
      </td>

      <td class="love span3">
          <img src="{{ URL::base() }}/images/love2.gif">
      </td>
      <td class="span5">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nec hendrerit odio. Nunc id aliquet elit. Ut ultrices luctus vestibulum. Suspendisse potenti. Sed ut faucibus magna. Donec semper congue placerat.
      </td>
  </tr>

  <tr class="span12">
    <td class="comment userinfo span3">
      <p class="name titlesection"> Maya Hasan</p>
      <p>DKI JAKARTA</p>
      <p>(23 Reviews)</p>
  </td>

  <td class="love span3">
      <img src="{{ URL::base() }}/images/love2.gif">
  </td>
  <td class="span5">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nec hendrerit odio. Nunc id aliquet elit. Ut ultrices luctus vestibulum. Suspendisse potenti. Sed ut faucibus magna. Donec semper congue placerat.
  </td>
</tr>
<tr class="span12">
    <td class="comment userinfo span3">
      <p class="name titlesection"> Maya Hasan</p>
      <p>DKI JAKARTA</p>
      <p>(23 Reviews)</p>
  </td>

  <td class="love span3">
      <img src="{{ URL::base() }}/images/love5.gif">
  </td>
  <td class="span5">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nec hendrerit odio. Nunc id aliquet elit. Ut ultrices luctus vestibulum. Suspendisse potenti. Sed ut faucibus magna. Donec semper congue placerat.
  </td>
</tr>
</table>
</div>
*/
?>


</div>


<script type="text/javascript">

$("#mainimageproduct").elevateZoom({gallery:'gallery_01', cursor: 'pointer', galleryActiveClass: 'active'});

$("#mainimageproduct").bind("click", function(e) {
    //var ez =   $('#img_01').data('elevateZoom');
    //$.fancybox(ez.getGalleryList());
    return false;
});

$('.addimage').on({
    'click': function(e){
        //find rel
        var idimage = $(this).attr("id");
        var zoomimage = $(this).attr("data-zoom-image");
        var imagesource = "{{ URL::base().'/storage/products/'.$product['_id'] }}";
        var imageLoad = imagesource+'/lar_pic'+idimage+'.jpg';

        $('#mainimageproduct').attr('src',imageLoad);


        return false;
    }
});
</script>

<div id="signInModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="signInLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="signInLabel">Sign In</h3>
</div>
<div class="modal-body">
    <p>Please sign in before making order, thank you.</p>
    <p>{{ Form::label('username', 'Email') }}</p>
    <p>{{ Form::text('username','',array('id'=>'signInUsername')) }}</p>
    <!-- password field -->
    <p>{{ Form::label('password', 'Password') }}</p>
    <p>{{ Form::password('password',array('id'=>'signInPassword')) }}</p>

</div>
<div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">No Thanks !</button>
    <button class="btn btn-primary" id="signInNow">Sign In Now !</button>
</div>
</div>

@endsection