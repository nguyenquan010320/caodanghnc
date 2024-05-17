<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Thiết kế web iHappy</title>
  <style type="text/css" media="screen">.ExternalClass{display:block!important;width:100%}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div{line-height:100%}body,p,h1,h2,h3,h4,h5,h6{margin:0;padding:0}body,p,td{font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#333;line-height:1.5em}h1{font-size:24px;font-weight:normal;line-height:24px}body,p{margin-bottom:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none}img{line-height:100%;outline:0;text-decoration:none;-ms-interpolation-mode:bicubic}a img{border:0}.background{background-color:#fff}table.background{margin:0;padding:0;width:100%!important}.block-img{display:block;line-height:0}a{color:white;text-decoration:none}a,a:link{color:#2a5db0;text-decoration:underline}table td{border-collapse:collapse}td{vertical-align:top;text-align:left}.wrap{width:600px}.wrap-cell{padding-top:30px;padding-bottom:30px}.header-cell,.body-cell,.footer-cell{padding-left:20px;padding-right:20px}.header-cell{background-color:#eee;font-size:24px;color:#fff}.body-cell{background-color:#fff;padding-top:30px;padding-bottom:34px}.footer-cell{background-color:#eee;text-align:center;font-size:13px;padding-top:30px;padding-bottom:30px}.card{width:400px;margin:0 auto}.data-heading{text-align:right;padding:10px;background-color:#fff;font-weight:bold}.data-value{text-align:left;padding:10px;background-color:#fff}.force-full-width{width:100%!important}</style>
  <style type="text/css" media="only screen and (max-width: 600px)">@media only screen and (max-width:600px){body[class*="background"],table[class*="background"],td[class*="background"]{background:#eeeeee!important}table[class="card"]{width:auto!important}td[class="data-heading"],td[class="data-value"]{display:block!important}td[class="data-heading"]{text-align:left!important;padding:10px 10px 0}table[class="wrap"]{width:100%!important}td[class="wrap-cell"]{padding-top:0!important;padding-bottom:0!important}}</style>
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" bgcolor="" class="background">
  <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" class="background">
    <tr>
      <td align="center" valign="top" width="100%" class="background">
        <center>
          <table cellpadding="0" cellspacing="0" width="600" class="wrap">
            <tr>
              <td valign="top" class="wrap-cell" style="padding-top:30px;padding-bottom:30px">
                <table cellpadding="0" cellspacing="0" class="force-full-width" style="border:1px #efefef solid">
                  <tr>
                    <td height="60" valign="top" class="header-cell" style="background:#4e68b9;padding:0 25px;vertical-align:middle">
                      <a href="https://ihappy.vn" target="_blank" style="text-decoration:none;color:#ffffff"><h3>Thiết kế web iHappy</h3></a>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top" class="body-cell">
                      <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff">
                        <tr>
                          <td valign="top" style="padding-bottom:20px;background-color:#fff">
                            Xin chào,<br>
                            Có ai đó đã điền thông tin trên website của bạn: <a href="{!!env('APP_URL')!!}" target="_blank">{!!env('COMPANY_WEBSITE')!!}</a><br>Nội dung như sau:
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff">
                              <tr>
                                <td align="center" style="padding:20px 0">
                                  <center>
                                    <table cellspacing="0" cellpadding="0" class="card">
                                      <tr>
                                        <td style="background-color:#4e68b9;text-align:center;padding:10px;color:white">
                                          {!!(!empty($data['subject']))?$data['subject']:'Nội dung thông báo'!!}
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="border:1px solid #4e68b9">
                                          <table cellspacing="0" cellpadding="20" width="100%">
                                            <tr>
                                              <td>
                                                <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff">
                                                  @foreach($data as $k=>$d)
                                                  <tr>
                                                    <td width="150" class="data-heading">
                                                      {!!$k!!}
                                                    </td>
                                                    <td class="data-value">
                                                      {!!$d!!}
                                                    </td>
                                                  </tr>
                                                  @endforeach
                                                </table>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                  </center>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td style="padding-top:20px;background-color:#ffffff">
                            Xin cảm ơn!<br>
                            <a href="https://ihappy.vn" target="_blank">Thiết kế web iHappy</a>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top" class="footer-cell">
                      Thiết kế web iHappy<br>
                      Tận tâm - Chuyên nghiệp - Sáng tạo<br>
                      ĐT: <a href="tel:84936388025" target="_blank">0936.388.025</a> - Email: <a href="mailto:ihappy.asia@gmail.com" target="_blank">ihappy.asia@gmail.com</a>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </center>
      </td>
    </tr>
  </table>
</body>
</html>