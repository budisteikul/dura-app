<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Vertikal Trip</title>
  <style type="text/css" rel="stylesheet" media="all">
    /* Base ------------------------------ */
    *:not(br):not(tr):not(html) {
      font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
    }
    body {
      width: 100% !important;
      height: 100%;
      margin: 0;
      line-height: 1.4;
      background-color: #F5F7F9;
      color: #000000;
      -webkit-text-size-adjust: none;
    }
    a {
      color: #414EF9;
    }

    /* Layout ------------------------------ */
    .email-wrapper {
      width: 100%;
      margin: 0;
      padding: 0;
      background-color: #F5F7F9;
    }
    .email-content {
      width: 100%;
      margin: 0;
      padding: 0;
    }

    /* Masthead ----------------------- */
    .email-masthead {
      padding: 25px 0;
      text-align: center;
    }
    .email-masthead_logo {
      max-width: 400px;
      border: 0;
    }
    .email-masthead_name {
      font-size: 16px;
      font-weight: bold;
      color: #839197;
      text-decoration: none;
      text-shadow: 0 1px 0 white;
    }

    /* Body ------------------------------ */
    .email-body {
      width: 100%;
      margin: 0;
      padding: 0;
      border-top: 1px solid #000000;
      border-bottom: 1px solid #000000;
      background-color: #FFFFFF;
    }
    .email-body_inner {
      width: 570px;
      margin: 0 auto;
      padding: 0;
    }
    .email-footer {
      width: 570px;
      margin: 0 auto;
      padding: 0;
      text-align: center;
    }
    .email-footer p {
      color: #839197;
    }
    .body-action {
      width: 100%;
      margin: 30px auto;
      padding: 0;
      text-align: center;
    }
    .body-sub {
      margin-top: 25px;
      padding-top: 25px;
      border-top: 1px solid #000000;
    }
    .content-cell {
      padding: 35px;
    }
    .align-right {
      text-align: right;
    }

    /* Type ------------------------------ */
    h1 {
      margin-top: 0;
      color: #292E31;
      font-size: 19px;
      font-weight: bold;
      text-align: left;
    }
    h2 {
      margin-top: 0;
      color: #292E31;
      font-size: 16px;
      font-weight: bold;
      text-align: left;
    }
    h3 {
      margin-top: 0;
      color: #292E31;
      font-size: 14px;
      font-weight: bold;
      text-align: left;
    }
    p {
      margin-top: 0;
      color: #000000;
      font-size: 16px;
      line-height: 1.5em;
      text-align: left;
    }
    p.sub {
      font-size: 12px;
    }
    p.center {
      text-align: center;
    }

    /* Buttons ------------------------------ */
    .button {
      border-radius: 3px;
    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
    color: #FFF;
    display: inline-block;
    text-decoration: none;
    -webkit-text-size-adjust: none;
    }
    .button--green {
      background-color: #2ab27b;
    border-top: 10px solid #2ab27b;
    border-right: 18px solid #2ab27b;
    border-bottom: 10px solid #2ab27b;
    border-left: 18px solid #2ab27b;
    }
    .button--red {
      background-color: #bf5329;
    border-top: 10px solid #bf5329;
    border-right: 18px solid #bf5329;
    border-bottom: 10px solid #bf5329;
    border-left: 18px solid #bf5329;
    }
    .button--blue {
      background-color: #3097D1;
    border-top: 10px solid #3097D1;
    border-right: 18px solid #3097D1;
    border-bottom: 10px solid #3097D1;
    border-left: 18px solid #3097D1;
    }

    /*Media Queries ------------------------------ */
    @media only screen and (max-width: 600px) {
      .email-body_inner,
      .email-footer {
        width: 100% !important;
      }
    }
    @media only screen and (max-width: 500px) {
      .button {
        width: 100% !important;
      }
    }
  </style>
</head>
<body>
  <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">
        <table class="email-content" width="100%" cellpadding="0" cellspacing="0">
          <!-- Logo -->
          <tr>
            <td class="email-masthead">
              <a class="email-masthead_name">Vertikal Trip</a>
            </td>
          </tr>
          <!-- Email Body -->
          <tr>
            <td class="email-body" width="100%">
              <table class="email-body_inner" width="570" cellpadding="0" cellspacing="0">
                <!-- Body content -->
                <tr>
                  <td class="content-cell">
                    
                    <h1>Hi {{$name}},</h1>
                    <p>Thank you for booking our tour. {{ $tour }} will start at {{ $date }}. Our meeting point is Tugu Yogyakarta Monument</p>
                    <!-- Action -->
                    
                    <!-- Sub copy -->
                    
                    <table class="body-sub" width="100%">
                      <tr>
                        <td>
                          <p>
                          <strong>Product : </strong>{{$tour}}<br />
                          <strong>Name : </strong>{{$name}}<br />
                            <strong>Email :</strong> {{$email}}<br />
                            <strong>Phone :</strong> {{$phone}}<br />
                            <strong>Date :</strong> {{$date}}<br />
                          <strong>Number of travelers :</strong> {{$os0}} 
                          <br />
                          <strong>Ticket : </strong> <a href="https://www.vertikaltrip.com/ticket/{{$ticket}}">{{$ticket}}</a>
						  <br />
                          <strong>Meeting point :</strong> <a href="https://goo.gl/maps/bsk9cGSh9iuUX7e46">Tugu Yogyakarta Monument (Tugu Pal Putih)<br />
Cokrodiningratan, Kec. Jetis, Kota Yogyakarta,<br />Daerah Istimewa Yogyakarta 55233</a>
                          </p>
                          
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-cell">
                    <p class="sub center">Vertikal Trip <br />
                    Tugu Yogyakarta Monument (Tugu Pal Putih)<br />
Cokrodiningratan, Kec. Jetis, Kota Yogyakarta,<br />Daerah Istimewa Yogyakarta 55233
                    </p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
