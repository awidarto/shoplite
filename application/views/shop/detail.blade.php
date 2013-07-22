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


        @if($_SERVER['HTTP_HOST'] != 'localhost')

            <iframe src="//www.facebook.com/plugins/like.php?href={{ urlencode( URL::full() ) }}&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=true&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>
            <br />
            <a href="https://twitter.com/share" class="twitter-share-button" data-via="peachtoblack" data-hashtags="peachtoblack">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

        @endif

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

        if($('select[name="size"]').val() == '-'){
            var soldout = '<option value="-" selected >-</option>';
            $('select[name="qty"]').html(soldout);

            $('select[name="color"]').html('')
            .simplecolorpicker('destroy')
            .simplecolorpicker();

        }else{

            $.post('{{ URL::to('shop/color')}}',{ size: this.value, _id:product_id },function(data){
                $('select[name="color"]').html(data.html)
                .simplecolorpicker('destroy')
                .simplecolorpicker();

                $.post('{{ URL::to('shop/qty')}}',{ color: data.defsel, size: $('select[name="size"]').val(), _id:product_id },function(data){

                    if(data.qty == 0){
                        var soldout = '<option value="-" selected >SOLD OUT</option>';
                        $('select[name="qty"]').html(soldout);
                        $('select[name="qty"]').hide();
                        $('#soldout-sign').show();
                    }else{
                        $('#soldout-sign').hide();
                        $('select[name="qty"]').show();
                        $('select[name="qty"]').html(data.html);
                    }

                },'json');

            },'json');

        }

    });

    $('select[name="color"]').simplecolorpicker().on('change',function(){

        if($('select[name="size"]').val() == '-'){

            var soldout = '<option value="-" selected >-</option>';
            $('select[name="qty"]').html(soldout);

            $('select[name="color"]').html('')
            .simplecolorpicker('destroy')
            .simplecolorpicker();

        }else{

            $.post('{{ URL::to('shop/qty')}}',{ color: $(this).val(), size: $('select[name="size"]').val(), _id:product_id },function(data){

                if(data.qty == 0){
                    var soldout = '<option value="-" selected >SOLD OUT</option>';
                    $('select[name="qty"]').html(soldout);
                    $('select[name="qty"]').hide();
                    $('#soldout-sign').show();
                }else{
                    $('#soldout-sign').hide();
                    $('select[name="qty"]').show();
                    $('select[name="qty"]').html(data.html);
                }


            },'json');

        }

    });


    @if(Auth::shoppercheck() == false)

        $('#addtocart').click(function(){
            var selqty = $('select[name="qty"]').val();

            var color = $('select[name="color"]').val();
            var size = $('select[name="size"]').val();
            var qty = $('select[name="qty"]').val();

            if( size == '-' || color == '-' || qty == '-'){

                alert('Please specify size, color and quantity');

            }else{

                if(qty == 0 || qty == '-'){
                    alert( 'This particular item is SOLD OUT, you may try select other color or size.');
                }else{
                    $('#signInModal').modal();
                }

            }



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
                        $('#signInModal').modal('hide');
                    }

                    if(data.result == 'OK:ITEMADDED'){
                        if(data.cartcount == 0){
                            $('#shopping-badge').html('');
                        }else{
                            $('#shopping-badge').html(data.cartcount);
                        }
                        alert(data.message);
                        $('#signInModal').modal('hide');
                        window.location = '{{ URL::full() }}';
                    }
            },'json');

        });

    @else

        $('#addtocart').click(function(){
            var color = $('select[name="color"]').val();
            var size = $('select[name="size"]').val();
            var qty = $('select[name="qty"]').val();

            if( size == '-' || color == '-'){

                alert('Please specify size, color and quantity');

            }else{

                if(qty == 0 || qty == '-'){

                    alert( 'This product and variant is SOLD OUT !');

                    if(qty == 0){
                        var soldout = '<option value="-" selected >SOLD OUT</option>';
                        $('select[name="qty"]').html(soldout);
                        $('select[name="qty"]').hide();
                        $('#soldout-sign').show();
                    }else{
                        $('#soldout-sign').hide();
                        $('select[name="qty"]').show();
                        $('select[name="qty"]').html(data.html);
                    }

                }else{

                    if(color != '' && size != '-' && qty >= 0){

                        $.post('{{ URL::to('shop/addtocart')}}',{ color: color, size: size, qty: qty, _id:product_id, cart_id: cart_id },function(data){
                            console.log(data);
                            if(data.result == 'NOTSIGNEDIN'){
                                alert(data.message);
                            }

                            if(data.result == 'PRODUCTADDED'){
                                var remaining = data.data.remaining;

                                if( remaining == 0){
                                    var soldout = '<option value="-" selected >SOLD OUT</option>';
                                    $('select[name="qty"]').html(soldout);
                                    $('select[name="qty"]').hide();
                                    $('#soldout-sign').show();
                                }else{
                                    var qtyopt = '';

                                    for(i = 1; i <= remaining; i++){
                                        qtyopt += '<option value="' + i + '" >' + i + '</option>';
                                    }

                                    $('select[name="qty"]').html(qtyopt);

                                }

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

                }

            }


    })

    @endif

    });
    </script>

    <div class="span3">
        <span class="titleselectbox">SELECT QUANTITY</span><br/>
        <span id="soldout-sign" style="display:none" >SOLD OUT</span>
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

                @if( isset($r['_id']) && file_exists(realpath('public/storage/products/'.$r['_id']->__toString()).'/sm_pic0'.$r['defaultpic'].'.jpg'))
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


                @if( isset($r['_id']) && file_exists(realpath('public/storage/products/'.$r['_id']->__toString()).'/sm_pic0'.$r['defaultpic'].'.jpg'))
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


<div class="commentlist span12">
    <h4 class="commentlisttitle">what other costumers saying about this product:</h4>
    <table>

    @if(Auth::shoppercheck() == true)
        <tr>
            <td colspan="3">We love feedback, add your comment here :</td>
        </tr>

        <script type="text/javascript">

        $(document).ready(function(){

            $('#send-comment').on('click',function(){


                if($('#star').raty('score') === 'undefined'){
                    var score = 0;
                }else{
                    var score = $('#star').raty('score');
                }

                $.post('{{ URL::to('ajax/comment')}}',{
                        product: '{{ $product['_id'] }}',
                        score: score,
                        comment: $('#my-comment').val()
                    },function(data){

                        if(data.result == 'OK'){

                            var ins = '<tr class="span12" style="opacity:0.1;">';
                            ins +=     '<td class="comment userinfo span3">';
                            ins +=       '<p class="name titlesection">' + data.data.shopper_name + '</p>';
                            ins +=       '<p>' + data.data.shopper_city + '</p>';
                            ins +=     '</td>';
                            ins +=     '<td class="love span3">';

                            for(s = 0; s < score ; s++){
                                ins += '<img src="{{ URL::base() }}/images/love-on.png" alt="love" />';
                            }

                            ins +=     '</td>';
                            ins +=     '<td class="span5">';
                            ins +=         '<p>' + data.data.comment + '</p>';
                            ins +=     '</td>';
                            ins += '</tr>';

                            $('#no-comment').hide();

                            $(ins).insertAfter( $('#comment-input') )
                                .animate({
                                opacity: 1
                                }, 1500 );

                        }else{
                            alert(data.message);
                        }

                },'json');

            });

        });

        </script>

        <tr class="span12" id="comment-input">
            <td class="comment userinfo span3" style="vertical-align:top" >
                  <p class="name titlesection">{{ Auth::shopper()->firstname.' '.Auth::shopper()->lastname }}</p>
                  <p>{{ Auth::shopper()->city }}</p>
            </td>
            <td class="love span3" style="vertical-align:top">
                <p>send some love</p>
                <div id="star"></div>
            </td>
            <td class="span6" style="vertical-align:top">
                <p>and say something</p>
                <textarea id="my-comment" style="width:90%"></textarea>&nbsp;&nbsp;<button id="send-comment" >Send</button>
            </td>
        </tr>


    @endif

    @if(count($product['comments']) > 0)

        @foreach( $product['comments'] as $com)

        <tr class="span12">
            <td class="comment userinfo span3">
              <p class="name titlesection">{{ $com['shopper_name'] }}</p>
              <p>{{ $com['shopper_city'] }}</p>
            </td>

            <td class="love span3">
                @for($s = 0; $s < $com['score']; $s++)
                    <img src="{{ URL::base() }}/images/love-on.png" alt="love" />
                @endfor
            </td>
            <td class="span5">
                <p>
                    {{ $com['comment'] }}
                </p>
            </td>
        </tr>

        @endforeach

    @else
        <tr id="no-comment">
            <td colspan="3">No comments yet, sign up and be the first to send some love</td>
        </tr>
    @endif


</table>
</div>


</div>


<script type="text/javascript">

    $('#star').raty({
        path :'{{ URL::base()}}/images/',
        starHalf : 'love-half.png',
        starOff : 'love-off.png',
        starOn : 'love-on.png',
        width: '150px'
    });

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