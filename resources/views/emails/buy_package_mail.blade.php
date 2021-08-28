<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ senderName() }}   </title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="big-deal">
    <meta name="keywords" content="big-deal">
    <meta name="author" content="big-deal">
    <!-- <link rel="icon" href="../assets/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon/favicon.ico" type="image/x-icon"> -->

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">

    <style type="text/css">
        body{
            text-align: center;
            margin: 0 auto;
            width: 650px;
            font-family: 'Open Sans', sans-serif;
            background-color: #e2e2e2;
            display: block;
        }
        ul{
            margin:0;
            padding: 0;
        }
        li{
            display: inline-block;
            text-decoration: unset;
        }
        a{
            text-decoration: none;
        }
        p{
            margin: 15px 0;
        }

        h5{
            color:#444;
            text-align:left;
            font-weight:400;
        }
        .text-center{
            text-align: center
        }
        .main-bg-light{
            background-color: #fafafa;
        }
        .title{
            color: #444444;
            font-size: 22px;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 10px;
            padding-bottom: 0;
            text-transform: uppercase;
            display: inline-block;
            line-height: 1;
        }
        table{
            margin-top:30px
        }
        table.top-0{
            margin-top:0;
        }
        table.order-detail , .order-detail th , .order-detail td {
            border: 1px solid #ddd;
            border-collapse: collapse;
        }
        .order-detail th{
            font-size:16px;
            padding:15px;
            text-align:center;
        }
        .footer-social-icon tr td img{
            margin-left:5px;
            margin-right:5px;
        }
    </style>
</head>
<body style="margin: 20px auto;">
<table align="center" border="0" cellpadding="0" cellspacing="0" style="padding: 0 30px;background-color: #f8f9fa; -webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);width: 100%;">
    <tbody>
    <tr>
        <td>
            <table align="center" border="0" cellpadding="0" cellspacing="0" >
                <tr>
                    <td>
                        <h2 class="title"> شكرا لك  </h2>
                        {{-- <h2 class="title">{{ __('site.thank you')}}  </h2> --}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>{{ $msg??''}}</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
