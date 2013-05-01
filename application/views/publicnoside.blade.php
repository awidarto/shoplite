
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <title>The 37th IPA Convention and Exhibition | Official Page</title>
  <link rel='shortcut icon' href='http://www.ipa.or.id/convex/favicon.ico'/>
  {{ HTML::style('css/foundation-form.css') }}
  {{ HTML::style('css/ipaconvex.css') }}
  {{ HTML::style('css/select2.css') }}
  {{ HTML::style('css/flick/jquery-ui-1.9.2.custom.min.css') }}
  {{ HTML::style('css/smart_wizard.css') }}

  <!--<link rel="stylesheet" type="text/css" media="screen" href="http://www.ipaconvex.com/css/cycle_index.css">
  <link rel="stylesheet" type="text/css" href="http://www.ipaconvex.com/css/navbar.css" />-->

    <!--<script type="text/javascript" src="http://ipa.or.id/js/smooth_top/smooth.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ipa.or.id/js/htmltooltip/htmltooltip.css" />
    <script type="text/javascript" src="http://ipa.or.id/js/htmltooltip/htmltooltip.js"></script>
  -->
    <!--[if lt IE 7.]>
    <script defer type="text/javascript" src="http://ipa.or.id/js/png/pngfix.js"></script>
    <![endif]-->
  <!--<link rel="stylesheet" href="http://www.ipaconvex.com//fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="all" />-->

  {{ HTML::script('js/jquery-1.8.3.min.js') }}
  {{ HTML::script('js/jquery-ui-1.9.2.custom.min.js') }}

  {{ HTML::script('js/select2.min.js') }}
  {{ HTML::script('js/jquery.smartWizard-2.0.js') }}
  <!--<script src="http://www.ipaconvex.com/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
  <script type="text/javascript" src="http://www.ipaconvex.com/css/jquery.cycle.all.js"></script>

  <script type="text/javascript" src="http://www.ipaconvex.com/stmenu.js"></script>-->
  </head>

  <body>
      <div align="center">
      <table width="940" border="0" cellspacing="0" cellpadding="0">

        <tr height="340">
          <td background="http://www.ipaconvex.com/head_web.jpg" height="340" width="940" valign="bottom">
            <div align="left" style="margin-bottom:15px;margin-left:10px;">

            <!--<script src="http://www.ipaconvex.com/jquery-blink.js" language="javscript" type="text/javascript"></script>

            <script type="text/javascript" language="javascript">

              $(document).ready(function()
              {
                      $('.blink').blink(); // default is 500ms blink interval.
                      //$('.blink').blink({delay:100}); // causes a 100ms blink interval.
              });

              </script>-->
              <div class="blink" style="margin: 0px 0px 15px 450px; color: black; font-size: 14px; font-weight: bold; font-family: Tahoma; visibility: visible;">
                {{ HTML::link('register/landing','ONLINE REGISTRATION',array('class'=>'')) }}
              </div>
            </td>
        </tr>
        <tr>
          <td width="940" height="35" bgcolor="#b60002" align="center" style="padding-left:170px;">
            



</td>
</tr>
<tr>
  <td bgcolor="white" width="940">
    <div align="center">
      <table width="910" border="0" cellspacing="0" cellpadding="0" style="padding-top:20px;padding-bottom:30px;">
        <tr valign="top">
          <td width="900">
            <table width="900">
              <tr>
                <p><br />
                </p>
                <td width="900">
                  @if(Auth::attendeecheck())
                  @if (Auth::attendee()->role == "EXH")
                  <p style="padding-left:7px;float:right;margin-right:30px;"><img src="http://www.ipaconvex.com/images/arrow1.jpg" border="0" align="absmiddle" style="margin-right:5px ">{{ HTML::link('exhibitor/profile','Back to my profile')}}</p>
                  <div class="clear"></div>
                  @yield('content')
                  @endif
                  @endif
                </td>

              </tr>
            </table>
          </td>
          <td width="50"><img src="http://www.ipaconvex.com/images/spacer.gif" width="1" height="1" alt="50" /></td>
          
          </tr>
        </table>
      </div>
    </td>
  </tr>
  <tr>
    <td bgcolor="white" width="940" background="http://www.ipaconvex.com/images/bg1.jpg">
      <table border="0" cellspacing="0" cellpadding="0" height="32">
        <tr>
          <td valign="top" width="9"><img src="http://www.ipaconvex.com/images/spacer.gif" /></td>
          <td valign="top" width="265"><div style="margin-left:17px; margin-top:14px; font-size:12px; color:#A70405 "> <strong>About IPA</strong></div></td>
          <td valign="top" width="242"><div style="margin-left:17px; margin-top:14px; font-size:12px; color:#A70405 "> <strong>General Information</strong></div></td>
          <td valign="top" width="241"><div style="margin-left:17px; margin-top:14px; font-size:12px; color:#A70405 "> <strong>Event Update</strong></div></td>
          <td valign="top" width="174"><div style="margin-left:17px; margin-top:14px; font-size:12px; color:#A70405 "> <strong>What's on the News</strong></div></td>
          <td valign="top" width="9"></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td bgcolor="white" width="940">
      <div align="center">
        <table width="940" border="0" cellspacing="0" cellpadding="0">
          <tr height="147">
            <td style="background-position:right top; background-repeat:repeat-y " valign="top" width="9" height="147" ALT="" background="http://www.ipaconvex.com/images/dot.jpg"></td>
            <td style="background-position:right top; background-repeat:repeat-y " valign="top" width="265" height="147" ALT="" background="http://www.ipaconvex.com/images/dot.jpg"><div style="margin-left:7px; margin-top:11px "> <img style="margin-right:12px " src="http://www.ipaconvex.com/images/1im1.png" align="left" />
              <div style="margin-top:9px; margin-right:10px" align="justify">
                <div align="left"> <a href="#"><strong>The 37<sup>th</sup> IPA Convention &amp; Exhibition</strong></a></div>
                <br />
                <br />
                <font color="#333333">The IPA Convention and Exhibition is one of the ways IPA goes about delivering its mission and it is Indonesia's premier event for the oil and gas industry. The IPA Convention and Exhibition aims to promote and attract investments into Indonesia. It showcases the latest technology and innovations, and supports the Indonesian government to identify and address major technical and non-technical challenges within the country's oil and gas industry.</font></div>
                <div style="margin-top:2px "> <a style="text-decoration:none " href="content.php?go=aboutipa"><strong>read more</strong></a><img style="margin-left:5px " src="http://www.ipaconvex.com/images/arrow1.jpg" align="absmiddle" border="0" /><br />
                  <br />
                </div>
              </div></td>
              <td style="background-position:right top; background-repeat:repeat-y " valign="top" width="242" height="147" ALT="" background="http://www.ipaconvex.com/images/dot.jpg">
                <div style="margin-left:17px; margin-top:11px ">
                  <table border="0" cellspacing="2" cellpadding="5">
                    <tr>
                      <td><strong>The 37th IPA Convention and Exhibition 2013</strong><br />
                        <br />
                        <strong>Theme</strong><br />
                        Promoting Investment in a Challenging Environment<br />
                        <br />
                        <strong>Date</strong><br />
                        15 – 17 May 2013 (Wednesday - Friday)<br />
                        <br />
                        <strong>Venue</strong><br />
                        Jakarta Convention Center<br />
                        Jl. Jendral Gatot Subroto <br />
                        Jakarta 10270<br />
                        Indonesia<br />
                        <br />
                        <strong>Exhibition Hours</strong><br />
                        <strong>Exhibitor</strong>&nbsp;: 08:00  –  19:00 WIB<br />
                        <strong>Visitor</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 10:00  –  18:00 WIB<br />
                        <strong>Entrance</strong> : By registration (online and onsite) </td>
                      </tr>
                    </table>
                  </div>
                </td>
                <td style="background-position:right top; background-repeat:repeat-y " valign="top" width="241" height="147" ALT="" background="http://www.ipaconvex.com/images/dot.jpg"><table width="100%">
                  <tr>
                    <td style="padding:5px 10px 0 15px;">
                      <strong>Exhibition Launch</strong><br />
                      Join us in Exhibition Launch that will be held at:<br />
                      <br />
                      <strong>Date</strong><br />
                      Tuesday, 29 January 2013<br />
                      <br />
                      <strong>Venue</strong><br />
                      Merak Room 1 & 2 – Lower Lobby<br />
                      Jakarta Convention Center<br />
                      <br />
                      <strong>Time</strong><br />
                      <strong>10:00 – 12:00 WIB</strong> (for booth 100 sqm and above)<br />
                      And <br />
                      <strong>13:00 – 16:00 WIB</strong> (for booth below 100 sqm)<br />
                      <br />
                      <strong>Agenda</strong><br />
                      Booth Drawing
                    </td>
                  </tr>
                </table>
              </div>

            </div>

          </td>


          <td style="background-position:right top; background-repeat:repeat-y " valign="top" width="174" height="147" ALT="" background="http://www.ipaconvex.com/images/dot.jpg"><div style="margin-left:17px; margin-top:11px "> <a href="content.php?go=calendar"><img style="margin-right:8px " src="http://www.ipaconvex.com/images/1im2.jpg" align="absmiddle" /></a></div>
            <div style="margin-top:8px; margin-left:16px "> </div>
            <br />
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr height="32">
                <td valign="top" height="32" background="http://www.ipaconvex.com/images/bg2.jpg"><div style="margin-left:17px; margin-top:14px; font-size:12px; color:#A70405 "> <strong>Get Connected!</strong></div></td>
              </tr>
              <tr>
                <td><div style="margin-left:17px; margin-top:11px "> <img style="margin-right:8px " src="http://www.ipaconvex.com/images/logo_twitter.png" width="30" align="absmiddle" /> <strong><a href="https://twitter.com/IPAConvex" target="_blank">Twitter</a></strong></div>
                  <div style="margin-left:17px; margin-top:7px "> Stay Connected with other members of the Event community.</div>
                  <br /></td>
                </tr>
              </table>
              <div style="margin-left:0px"></div></td>
              <td style="background-position:right top; background-repeat:repeat-y " valign="top" width="9" height="147" ALT=""></td>
            </tr>
            <tr>
              <td height="15"></td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
    <tr height="13">
      <td bgcolor="white" width="940" height="13" background="http://www.ipaconvex.com/images/bottom.jpg"></td>
    </tr>
    <tr height="25">
      <td bgcolor="white" width="940" height="25"><div align="center">
        <table border="0" align="center" cellspacing="0" style="text-align:center;">
          <tr>
            <td></td>
            <td height="40"><div align="center">Organizer:</div></td>
            <td width="80">&nbsp;</td>
            <td height="40"><div align="center">Co-Organizer:</div></td>
          </tr>
          <tr>
            <td><p align="right"> <strong>Indonesian Petroleum Association</strong><br />
              Indonesia Stock Exchange Building, Tower II, 20th Floor, Suite 2001<br />
              Jl. Jend. Sudirman Kav. 52-53, Jakarta 12190, Indonesia<br />
              Telephone: (62-21) 515 5959, Facsimile: (62-21) 5140 2545/6<br />
              Email: <a href="mailto:ipa@cbn.net.id">ipa@cbn.net.id</a><br />
              <a href="http://www.ipa.or.id" target="_blank">www.ipa.or.id</a></p></td>
              <td height="80" valign="top"><div align="center"><img src="http://www.ipaconvex.com/images/ipa-logo.jpg" alt="" width="90" height="90" style="padding-left:10px;" /></div></td>
              <td height="80">&nbsp;</td>
              <td height="80" valign="top"><div align="center"><img src="http://www.ipaconvex.com/images/dyandra-promo.jpg" alt="" width="70"  style="padding-right:10px; padding-top:10px;" /></div></td>
              <td><strong>PT Dyandra Promosindo</strong><br />
                The City Tower, 7th Floor<br />
                Jl. M.H. Thamrin No. 81, Jakarta 10130, Indonesia<br />
                Telephone: (62-21) 3199 6077, Facsimile: (62-21) 3199 6277<br />
                Email: <a href="mailto:marketingipa2013@dyandra.com">marketingipa2013@dyandra.com</a> <br />
                <a href="http://www.dyandra.com" target="_blank">www.dyandra.com</a></td>
              </tr>
              <tr>
                <td height="20"></td>
              </tr>
            </table>
          </div></td>
        </tr>
      </table>
    </div>
    <p>
    </p>
  {{ HTML::script('js/jquery.foundation.forms.js') }}
  {{ HTML::script('js/jquery.tagsinput.min.js') }}
  {{ HTML::script('js/pnu.js') }}

  <script type="text/javascript">
  $(document).ready(function(){
      $("input[name$='sameasinfo']").click(function() {
          var test = $(this).val();
          $(".billingInfo").hide();
          $("#"+test+"tsamebillingInfo").show();
      });
  });
  </script>
  </body>

  </html>



