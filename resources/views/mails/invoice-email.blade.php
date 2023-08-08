<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">

        <tr style="margin-bottom: 15px;">
            <td class="title">
                <img src="{{$deal->image}}" style="width: 150px;height: 150px" />
            </td>

            <td>
                <h3>{{$deal['title']}}</h3>
            </td>
        </tr>


        <tr class="heading">
            <td>Adviser Info</td>
            <td></td>
        </tr>

        <tr class="details">
            <td>Name</td>

            <td>{{$deal->user->fname}}</td>
        </tr>

        <tr class="heading">
            <td>Deal information</td>

            <td></td>
        </tr>

        <tr class="item">
            <td>Title</td>

            <td>{{$deal->title}}</td>
        </tr>

        <tr class="item">
            <td>Category</td>

            <td>{{$deal->category->name}}</td>
        </tr>

        <tr class="item">
            <td>City</td>

            <td>{{$deal->state->name}}</td>
        </tr>


        <tr class="item">
            <td>Description</td>

            <td>{!! $deal->description !!}</td>
        </tr>


        <tr class="item">
            <td>Teaser Text</td>

            <td>{!! $deal->teaser_text !!}</td>
        </tr>



        <tr class="heading">
            <td>Pricing</td>
            <td></td>
        </tr>

        <tr class="details">
            <td>Original Price</td>

            <td>${{$deal->price}}</td>
        </tr>

        <tr class="details">
            <td>Offer Price</td>

            <td>${{$deal->offer_price}}</td>
        </tr>

        <tr class="details">
            <td>Discount Code</td>

            <td>{{$deal->discountcode}}</td>
        </tr>

        <tr class="details">
            <td>Expiration Date</td>

            <td>{{$deal->expiration_date}}</td>
        </tr>



        <tr class="heading">
            <td>Amount</td>
            <td></td>
        </tr>

        <tr class="details">
            <td>Total Amount</td>

            <td>${{$payments->value}}</td>
        </tr>


{{--        <tr class="total">--}}
{{--            <td></td>--}}

{{--            <td>Total: $385.00</td>--}}
{{--        </tr>--}}
    </table>
</div>
</body>
</html>