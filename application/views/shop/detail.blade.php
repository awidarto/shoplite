@layout('public')

@section('content')
<div class="row">
  
  <div class="span4">
    <img src="{{ URL::base() }}/images/1.jpg" alt="mm01" class="mixmatch" />
    <br/>
    <a href="#"><img src="{{ URL::base() }}/images/roll-on.png"><span class="titlesectionnormal">ROLL ON TO ZOOM IN</span></a>
    <a style="margin-left:30px;" href="#"><img src="{{ URL::base() }}/images/zoom.png"><span class="titlesectionnormal">VIEW LARGER</span></a>
    <br/>
    <br/>
    <p>
      <span class="titlesection" style="text-align:center;width:100%;margin:0 auto;display:block;">ADDITIONAL IMAGES</span>
      
      <div class="addimages">
        @foreach($product['productpic'] as $pic)
        <a href="#"><img src="{{ URL::base() }}/images/kecil1.jpg"></a>
        <a href="#"><img src="{{ URL::base() }}/images/kecil2.jpg"></a>
      </div>
    </p>
  </div>
  <div class="span8 clearfix">
    <div class="detailproduct">
      <h2 class="product-title">Ponte Knit Shift <br/><i>by</i> Peach To Black</h2>
      <a href="#" class="fblike"><img src="{{ URL::base() }}/images/fblike.gif"/></a>
      <a href="#" class="loves"><img src="{{ URL::base() }}/images/loves4.gif"/><br/><span>based on 196loves</span></a>
      <div class="availablecont">
        <p>Available in:</p>
        <a href="#" class="coloravailableselect red"></a>
        <a href="#" class="coloravailableselect black"></a>
        <a href="#" class="coloravailableselect blue"></a>
      </div>
      <p>Price: IDR 575,000</p>
      <h3>ABOUT THIS PRODUCT</h3>
      <p class="titlesection">fabric & care</p>
      <ul>
        <li>89% Rayon, 9% Nylon, 2% Spandex.</li>
        <li>Handwash</li>
        <li>Imported</li>
      </ul>
      <p class="titlesection">overview</p>
      <ul>
        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit</li>
        <li>Praesent nec hendrerit odio</li>
      </ul>
      <p class="titlesection">fit & sizing</p>
      <ul>
        <li>Body length: Petite: 33 1/4", Regular: 35 1/4"</li>
      </ul>

      <p class="titlesection">shipping & returns</p>
      <ul>
        <li>FREE shipping on all orders over IDR 500,000</li>
        <li>Select "FREE" option in the shopping bag</li>
        <li>IDR 50,000 Flat rate for orders under IDR 250,000</li>
      </ul>
    </div>

    <div class="optionselectproduct detailproduct clearfix">
      <div class="selectsize">
        <span class="titleselectbox">SELECT SIZE</span><br/>        
        <select class="span2" size="1" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"><option value="-" selected="selected">-</option><option value="s">S</option><option value="m">M</option><option value="l">L</option></select>
      </div>

      <div class="selectsize">
        <span class="titleselectbox">SELECT QUANTITY</span><br/>        
        <select class="span2" size="1" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"><option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option></select>
      </div>
      <div class="selectsize">
        <span class="titleselectbox">ADD TO CART</span><br/>        
        <a href="#"><img src="{{ URL::base() }}/images/trolly.png"/></a>
      </div>
  </div>
  <div class="clear"></div>
  <div class="detailproduct statcomment">
    <span>5 comments</span>
    <a href="#"><img src="{{ URL::base() }}/images/fbstat.gif"></a>
    <a href="#"><img src="{{ URL::base() }}/images/twittstat.gif"></a>
    <a href="#"><img src="{{ URL::base() }}/images/googlestat.gif"></a>
  </div>
  
    <div class="clear"></div>
    

  </div>
  <div class="clear"></div>
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
  <div class="clear"></div>

  <div class="otherproducts span12">
    <h3>We also recomend</h3>
    <a href="#"><img src="{{ URL::base() }}/images/recomen1.jpg"></a>
    <a href="#"><img src="{{ URL::base() }}/images/recomen2.jpg"></a>
    <a href="#"><img src="{{ URL::base() }}/images/recomen3.jpg"></a>
    <a href="#"><img src="{{ URL::base() }}/images/recomen4.jpg"></a>
  </div>

</div>




@endsection